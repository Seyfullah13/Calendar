<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ical extends Model
{
    use HasFactory;
    protected $table = 'icals';
    protected $fillable = ['ical_url', 'property_id', 'partenaire_id', 'calendar_name'];

    public function property(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Property::class, 'id', 'property_id');
    }

    public function partenaire(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Partenaire::class, 'id', 'partenaire_id');
    }
}
