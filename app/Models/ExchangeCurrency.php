<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeCurrency extends Model
{
    use HasFactory;

    protected $fillable = [
        'currencyId', 
        'exchangeRates', 
        'dayOfExchange', 
        'exchangeto'
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currencyId');
    }
}
