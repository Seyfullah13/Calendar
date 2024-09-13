<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\MyUserRole;

class MyRole extends Model
{
    use HasFactory;

    public function userRoles(): HasMany
    {
        return $this->hasMany(MyUserRole::class);
    }
}
