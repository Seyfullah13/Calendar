<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFee extends Model
{
    use HasFactory;

    protected $table = 'property_fees';
    protected $fillable =['name','type','label','guests_included'];


    public function fees_pro(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(FeesProperty::class);
    }

}
