<?php

namespace App\Models;

use App\Models\Review;
use App\Models\Property;
use App\Models\PropertyEquipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'photos';
    protected $fillable =['url', 'order', 'description', 'tags'];

    public function properties()
    {
        return $this->morphedByMany(Property::class, 'photoable');
    }

    public function property_equipments()
    {
        return $this->morphedByMany(PropertyEquipment::class, 'photoable');
    }

    public function reviews()
    {
        return $this->morphedByMany(Review::class, 'photoable');
    }
}
