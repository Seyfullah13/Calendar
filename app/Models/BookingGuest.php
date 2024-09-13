<?php

namespace App\Models;

use App\Models\Review;
use App\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingGuest extends Model
{
    use HasFactory;
    protected $table = 'booking_guests';
    protected $fillable =['first_name', 'last_name', 'email', 'phone', 'picture'];

    public function booking(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function contact(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->HasOne(Contact::class, 'id', 'contact_id');
    }

    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function address(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public static function mergeGuests(array $guestIds, array $fieldsToMerge = [])
    {
        // Récupération des invités à fusionner
        $guests = self::whereIn('id', $guestIds)->get();

        // Vérifier s'il y a suffisamment d'invités à fusionner
        if ($guests->count() < 2) {
            throw new \Exception("Vous devez sélectionner au moins deux invités à fusionner.");
        }

        // Le premier invité dans la liste sera l'invité principal
        $mainGuest = $guests->shift();

        // Parcourir chaque invité secondaire
        foreach ($guests as $guest) {
            // Fusionner les données fournies dans $fieldsToMerge
            foreach ($fieldsToMerge as $field => $value) {
                if ($value === null) {
                    continue;
                }

                // Mise à jour des champs
                if ($field === 'first_name') {
                    $mainGuest->first_name = $value;
                } elseif ($field === 'last_name') {
                    $mainGuest->last_name = $value;
                } elseif ($field === 'email') {
                    $mainGuest->email = $value;
                } elseif ($field === 'phone') {
                    $mainGuest->phone = $value;
                } elseif ($field === 'picture') {
                    $mainGuest->picture = $value;
                }
            }

            // Suppression de l'invité secondaire après la fusion
            $guest->delete();
        }

        // Sauvegarde des modifications sur l'invité principal
        $mainGuest->save();

        return $mainGuest;
    }

}
