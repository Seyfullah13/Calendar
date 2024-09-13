<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partenaire extends Model
{
    use HasFactory;
    protected $table = 'partenaires';
    protected $fillable = ['name', 'url_commercial', 'url_api', 'icon', 'description'];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function statusCo(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(StatusCorrespondance::class);
    }

    public function ical(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Booking::class);
    }

    // Définir la relation many-to-many
    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_partenaire');
    }
}
