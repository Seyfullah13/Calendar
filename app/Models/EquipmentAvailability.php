<?php

namespace App\Models;

use App\Models\PropertyEquipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentAvailability extends Model
{
    use HasFactory;
    
    protected $fillable =['date_start','date_end'];

    /**
     * Get the propertyEquipment that owns the EquipmentAvailability
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function propertyEquipment(): HasOne
    {
        return $this->hasOne(PropertyEquipment::class, 'availability_id', 'id');
    }
}
