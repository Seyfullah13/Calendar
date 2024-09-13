<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'currencies';
    protected $fillable =['name', 'code', 'symbol', 'symbol_first', 'decimal_mark', 'thousand_separator', 'icon'];

    
    public function attribute(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PropertyAttribute::class, 'currency_id', 'id');
    }
}
