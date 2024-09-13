<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyPartenaire extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'property_partenaire';
    protected $fillable = ['property_id', 'partenaire_id'];
}
