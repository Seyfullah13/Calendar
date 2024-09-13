<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyEquipment extends Model
{
    use HasFactory;

    protected $table = 'property_equipments';
    protected $fillable =[
        'id',
        'description_id',
        'equipment_id',
        'availability_id',
        'parent_id',
        'private',
        'number',
        'order',
    ];


    public function description(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EquipmentDescription::class,'description_id');
    }

    public function photos(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Photo::class, 'photoable');
    }

    public function availability(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EquipmentAvailability::class,'availability_id');
    }

    public function equipment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Equipment::class,'equipment_id');
    }

    public function properties(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'property_property_equipment', 'property_equipment_id', 'property_id');
    }
}
