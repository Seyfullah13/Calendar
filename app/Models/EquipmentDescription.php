<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentDescription extends Model
{
    use HasFactory;
    protected $table = 'equipment_descriptions';
    protected $fillable =['nickname', 'description', 'is_room','is_furniture','is_accesory'];


    public function equipment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Equipment::class);
    }
}
