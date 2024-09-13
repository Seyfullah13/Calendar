<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAttribute extends Model
{
  use HasFactory;
  public $timestamps = false;

  protected $table = 'property_attributes';
  protected $fillable = ['display_name', 'name', 'description', 'summary', 'square_metre', 'time_zone', 'property_type_id', 'currency_id', 'maximum_capacity', 'bedrooms', 'beds', 'bathrooms', 'pets', 'smoking', 'party', 'created_at', 'updated_at'];

  public function setDisplayNameAttribute($value)
  {
    $this->attributes['display_name'] = $value ?: $this->name;
  }

  public function property(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Property::class, 'property_attribute_id', 'id');
  }


  public function currency(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(Currency::class, 'id', 'currency_id');
  }

  // property belong to type
  public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(PropertyType::class, 'property_type_id');
  }
}