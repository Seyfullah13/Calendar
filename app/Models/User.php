<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Wave\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'username',
        'password',
        'verification_code',
        'verified',
        'trial_ends_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = [
        'contact',
    ];

    protected $appends = [
        'contacts',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'trial_ends_at' => 'datetime',
    ];

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    /**
     * Get user contacts
     * 
     * @return Collection|Contact[]
     */
    public function getContactsAttribute(): Collection
    {
        return optional($this->contact)->contacts() ?? collect();
    }

    public function userRoles(): HasMany
    {
        return $this->hasMany(MyUserRole::class);
    }
}
