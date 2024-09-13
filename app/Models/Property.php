<?php

namespace App\Models;

use App\Models\Review;
use App\Models\MyUserRole;
use App\Models\FeesProperty;
use App\Models\PropertyFees;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str; // Facultatif, si vous avez besoin d'autres fonctions de Str

class Property extends Model
{
  use HasFactory;
  public $timestamps = false;

  protected $table = 'properties';
  protected $fillable = ['property_attribute_id', 'external_id'];


  // Définition du mutateur pour display_name
  public function setDisplayNameAttribute($value)
  {
    $this->attributes['display_name'] = $value ?: $this->name;
  }
  public function attribute(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(PropertyAttribute::class, 'id', 'property_attribute_id');
  }

  public function address(): \Illuminate\Database\Eloquent\Relations\MorphOne
  {
    return $this->morphOne(Address::class, 'addressable');
  }

  // Définir la relation many-to-many
  public function partenaires()
  {
    return $this->belongsToMany(Partenaire::class, 'property_partenaire');
  }

  public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Review::class);
  }

  /**
   * Récupère les taxes associées à cette propriété.
   */
  public function fees(): \Illuminate\Database\Eloquent\Relations\hasManyThrough
  {
    return $this->hasManyThrough(
      PropertyFees::class, // Modèle de destination
      FeesProperty::class, // Modèle intermédiaire
      'property_id', // Clé étrangère de Property dans FeesProperty
      'id', // Clé primaire de PropertyFees
      'id', // Clé primaire de Property
      'property_fees_id' // Clé étrangère de PropertyFees dans FeesProperty
    );
  }

  public function booking(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
  {
    return $this->belongsToMany(Booking::class, 'property_id', 'id');
  }

  public function ical(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
  {
    return $this->belongsToMany(Booking::class, 'property_id', 'id');
  }

  public function photos(): \Illuminate\Database\Eloquent\Relations\MorphToMany
  {
    return $this->morphToMany(Photo::class, 'photoable');
  }

  // Ajoutez cette méthode pour obtenir l'URL de la première image
  public function getFirstPhotoUrlAttribute()
  {
    return $this->photos()->exists() ? $this->photos->first()->url : null;
  }

  public function propertyEquipments(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
  {
    return $this->belongsToMany(PropertyEquipment::class, 'property_property_equipment', 'property_id', 'property_equipment_id');
  }

  public function userRoles(): HasMany
  {
    return $this->hasMany(MyUserRole::class);
  }

  protected static function booted()
  {
    static::creating(function ($property) {
      do {
        // Génère une chaîne de 10 chiffres aléatoires
        $externalId = str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
      } while (self::where('external_id', $externalId)->exists());

      $property->external_id = $externalId;
    });
  }
}