<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Property;
use App\Models\MyRole;

class MyUserRole extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'my_user_roles';

    protected $fillable = [
        'user_id',
        'property_id',
        'my_role_id',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function role()
    {
        return $this->belongsTo(MyRole::class, 'my_role_id');
    }

}
