<?php

namespace App\Models;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentDependency extends Model
{
    use HasFactory;
    
    protected $fillable = ['parent_id','child_id'];

    public function parentId(): Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Equipment::class, 'parent_id');
    }

    public function childId(): Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Equipment::class, 'child_id');
    }
}
