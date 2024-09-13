<?php

namespace App\Models;

use App\Models\EquipmentModel;
use App\Models\PropertyEquipment;
use App\Models\EquipmentDependency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable =['name'];

    /**
     * Get all of the dependencies for the Equipment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dependencies(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(EquipmentDependency::class);
    }

    /**
     * Get all of the propertyEquipments for the Equipment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function propertyEquipments(): HasMany
    {
        return $this->hasMany(PropertyEquipment::class);
    }

    /**
     * The models that belong to the Equipment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function models(): BelongsToMany
    {
        return $this->belongsToMany(EquipmentModel::class);
    }
}
