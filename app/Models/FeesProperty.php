<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesProperty extends Model
{
    use HasFactory;


    public $timestamps = false;
    protected $table = 'fees_properties';
    protected $fillable =['property_id','property_fees_id','amount','operation','description'];

    public function propertyF(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function feesP(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PropertyFees::class);
    }


}
