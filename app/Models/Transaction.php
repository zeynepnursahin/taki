<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Modelin hangi tabloyu temsil ettiğini belirtir
    protected $table = 'transactions';

    // Toplu atamaya izin verilen alanlar
    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
        'type',
    ];

    /**
     * Kullanıcı ile ilişkisi
     * Her işlem bir kullanıcıya aittir.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // İşlem bir kullanıcıya aittir
    }

    /**
     * Sipariş ile ilişkisi
     * Her işlem bir siparişe aittir.
     */
    public function order()
    {
        return $this->belongsTo(Order::class); // İşlem bir siparişe aittir
    }

    /**
     * İşlem türlerini döndürür (ödeme veya geri ödeme).
     */
    public static function types()
    {
        return [
            'ödeme' => 'Ödeme',
            'geri ödeme' => 'Geri Ödeme',
        ];
    }
}
