<?php

namespace App\Http\Controllers;

use App\Mail\KullaniciKayitMail;
use App\Models\KullaniciDetay;
use App\Models\Sepet;
use App\Models\SepetUrun;
use App\Models\Kullanici;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isNull;
use Cart;

class KullaniciController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('oturumukapat');
    }

    public function giris_form()
    {
        return view('kullanici.oturumac');
    }

    public function kaydol_form()
    {
        return view('kullanici.kaydol');
    }

    public function kaydol()
    {
        $this->validate(request(), [
            'adsoyad' => 'required|min:5|max:30',
            'email' => 'required|email|unique:kullanici',
            'sifre' => 'required|confirmed|min:6|max:12',
        ]);

        $kullanici = Kullanici::create([
            'adsoyad' => \request('adsoyad'),
            'email' => \request('email'),
            'sifre' => Hash::make(request('sifre')),
            'aktivasyon_anahtari' => Str::random(60),
            'aktif_mi' => 0
        ]);

        $kullanici->detay()->save(new KullaniciDetay());

        Mail::to(request('email'))->send(new KullaniciKayitMail($kullanici));

        auth()->login($kullanici);
        return redirect()->route('anasayfa');
    }

    public function aktiflestir($anahtar)
    {
        $kullanici = Kullanici::where('aktivasyon_anahtari', $anahtar)->first();
        if (!isNull($kullanici)) {
            $kullanici->aktivasyon_anahtari = null;
            $kullanici->aktif_mi = 1;
            $kullanici->save();
            return redirect()->to('/')
                ->with('mesaj', 'Kaydınız Aktifleştirildi')
                ->with('mesaj_tur', 'success');
        } else {
            return redirect()->to('/')
                ->with('mesaj', 'Kullanıcı kaydınız aktifleştirilemedi')
                ->with('mesaj_tur', 'warning');
        }
    }

    public function giris()
    {
        $this->validate(\request(), [
            'email' => 'required|email',
            'sifre' => 'required'
        ]);

        $credentials = [
            'email' => \request('email'),
            'password' => \request('sifre'),
            'aktif_mi' => 1
        ];

        if (auth()->attempt($credentials, \request()->has('benihatirla'))) {
            \request()->session()->regenerate();

            // Aktif sepet ID işlemleri
            $aktif_sepet_id = Sepet::first()->aktif_sepet_id();
            if (!is_null($aktif_sepet_id)) {
                $this->sepet_guncelle($aktif_sepet_id);
            }

            return redirect()->route('anasayfa');
        } else {
            return back()->withInput()->withErrors(['email' => 'Giriş Hatalı']);
        }
    }

    public function oturumukapat()
    {
        auth()->logout();
        return redirect()->route('anasayfa');
    }
}
