<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Kullanici extends Authenticatable
{
    use HasFactory, Notifiable;

    // Kullanıcı modelinin ilgili tabloyu belirtmek
    protected $table = 'kullanici';

    // Doldurulabilir alanlar
    protected $fillable = [
        'adsoyad',
        'email',
        'sifre',
        'aktivasyon_anahtari',
        'aktif_mi',
        'yonetici_mi',
    ];

    // Gizli alanlar
    protected $hidden = [
        'sifre',
        'aktivasyon_anahtari',
    ];

    // Veri türlerini dönüştürmek için
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Şifre alanını Laravel'in `Auth` işlemleri için belirtir.
     */
    public function getAuthPassword()
    {
        return $this->sifre; // Şifre alanınızın adı
    }

    /**
     * Kullanıcı ile ilgili detayları ilişkilendirir.
     */
    public function detay()
    {
        return $this->hasOne('App\Models\KullaniciDetay')->withDefault();
    }

    /**
     * Kullanıcı ile ilişkili siparişleri getirir.
     */
    public function siparisler()
    {
        return $this->hasMany('App\Models\Order', 'user_id');
    }

    /**
     * Kullanıcının bakiyesiyle ilgili ilişki (Opsiyonel).
     */
    public function bakiye()
    {
        return $this->hasOne('App\Models\UserBalance');
    }

    /**
     * Kullanıcının admin olup olmadığını kontrol eder.
     */
    public function isAdmin()
    {
        return $this->yonetici_mi == 1;
    }

    /**
     * Kullanıcının onaylanmış siparişlerini getirir.
     */
    public function onayliSiparisler()
    {
        return $this->siparisler()->where('status', 'onaylandi');
    }

    /**
     * Kullanıcının iptal edilmiş siparişlerini getirir.
     */
    public function iptalSiparisler()
    {
        return $this->siparisler()->where('status', 'iptal edildi');
    }

    /**
     * Kullanıcıya ait aktif siparişi (yeni) getirir.
     */
    public function aktifSiparis()
    {
        return $this->siparisler()->where('status', 'onay bekliyor');
    }

    /**
     * Kullanıcıya ait teslim alınmış siparişi getirir.
     */
    public function teslimEdilenSiparisler()
    {
        return $this->siparisler()->where('status', 'teslim edildi');
    }
}
