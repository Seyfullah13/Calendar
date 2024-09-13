<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusCorrespondance extends Model
{
    use HasFactory;

    protected $table = 'status_correspondances';
    protected $fillable =['booking_status_id','partenaire_id','status'];
    public $timestamps = false;


    public function bookStat(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BookingStatus::class,'id', 'booking_status_id');
    }

    public function partenaire(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Partenaire::class, 'id' , 'partenaire_id');
    }

}
