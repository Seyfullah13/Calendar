<?php

namespace App\Livewire\Bookings\BookingForms;

use App\Models\Booking;
use App\Models\BookingGuest;
use App\Models\Currency;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use App\Models\Property;
use App\Models\PropertyAttribute;
use Carbon\Carbon;
use Filament\Notifications\Notification;

class ReviewBookings extends Component implements HasForms
{
    /**
     * Cette classe gère les formulaires d'ajout de réservation
     */

    use InteractsWithForms;


    public $block = false;
    public ?array $settingData = [];
    public ?array $guestData = [];
    public ?array $priceData = [];

    public $total_cost = 0;
    public $number_of_nights = 0;

    public $check_in;
    public $check_out;
    public $hold_booking;
    public $number_of_guest;
    public $number_of_animals;
    public $property_display_photo;
    public $property_display_name;
    public $property_name;


    // Listener pour capter les événements
    protected $listeners = [
        'priceDataDisplay' => 'hundlePriceData',
        'settingDataSubmitted' => 'hundleSettingData',
        'guestDataSubmitted' => 'hundleGuestData',
    ];

    public function hundlePriceData($priceData)
    {
        $this->priceData = $priceData;

        $this->total_cost = $this->priceData['total_payout'];
        $this->hold_booking = $this->priceData['hold_booking'];
    }

    public function hundleSettingData($settingData)
    {
        $this->settingData = $settingData;

        $this->number_of_nights = $this->get_number_of_nights();
        $this->check_in = $this->settingData['check_in'];
        $this->check_out = $this->settingData['check_out'];
        $this->number_of_guest = $settingData['number_of_adults'] + $settingData['number_of_children'];
        $this->number_of_animals = $settingData['number_of_animals'];

        $property = Property::with('attribute', 'photos')->find($settingData['property_id']);

        $this->property_display_name = $property->attribute->display_name;
        $this->property_name = $property->attribute->name;
        $this->property_display_photo = $property->first_photo_url;
        // dd($this->property_display_photo);

    }

    public function mount(): Void {}

    public function hundleGuestData($guestData)
    {
        $this->guestData = $guestData;
        // dd($this->guestData);
    }

    public function get_number_of_nights()
    {
        // Calcule du nombre de nuits
        $check_in = Carbon::parse($this->settingData['check_in']);
        $check_out = Carbon::parse($this->settingData['check_out']);
        $number_of_nights = $check_in->diffInDays($check_out) + 1;
        return $number_of_nights;
    }

    public function create()
    {
        /**
         * Méthode pour créer un booking
         */

        // Récupération des données de chaque formulaire
        $settingData = $this->settingData;
        $guestData = $this->guestData;
        $priceData = $this->priceData;

        //Récupération de l'identifiant de la propriété selectionnée
        $property = Property::find($settingData['property_id']);

        // Sauvegarde des informations du client (guest)
        $bookingGuest = BookingGuest::updateOrCreate(
            // Les critères de recherche pour trouver un enregistrement existant
            ['id' => $guestData['guest_id']],

            // Les valeurs à utiliser pour la création ou la mise à jour
            [
                'first_name' => $guestData['first_name'],
                'last_name' => $guestData['last_name'],
                'email' => $guestData['email'],
                'phone' => $guestData['phone'],
            ]
        );

        // Sauvegarde des informations de Booking
        $booking = new Booking();



        $reservation_plage = $settingData['reservation_plage'];

        $plage = explode(' - ', $reservation_plage);

        $inputFormat = 'd/m/Y';
        // Créer des objets DateTime à partir des chaînes
        $checkIn = DateTime::createFromFormat($inputFormat, $plage[0]);
        $checkOut = DateTime::createFromFormat($inputFormat, $plage[1]);

       // dd($checkIn);

        // Ajouter des heures spécifiques pour check-in et check-out
        $checkIn->setTime(15, 0);  // 15h00 pour check-in
        $checkOut->setTime(11, 0);  // 11h00 pour check-out

        // Définir le format de sortie
        $outputFormat = 'Y-m-d H:i:s';

        // Formater les dates au format désiré
        $formattedCheckIn = $checkIn->format($outputFormat);
        $formattedCheckOut = $checkOut->format($outputFormat);


        $booking->preparation_time = Carbon::now()->format('H:i:s');
        $booking->property_id = $property->id;
        $booking->check_in = $formattedCheckIn;
        $booking->check_out = $formattedCheckOut;
        $booking->number_of_nights = $this->number_of_nights;
        $booking->number_of_children = $settingData['number_of_children'];
        $booking->number_of_adults = $settingData['number_of_adults'];
        $booking->number_of_animals = $settingData['number_of_animals'];
        $booking->number_of_guests = $this->number_of_guest;
        $booking->booked_at = now();
        $booking->booking_guest_id = $bookingGuest->id;
        $booking->note = $guestData['note'] ?? '';
        $booking->total_taxes = $this->estimated_taxes ?? 0;
        $booking->total_payout = $this->total_cost;
        $booking->total_fees = 0;
        $booking->booking_status_id = 1; // Status En attente
        $booking->save();

        Notification::make()
            ->title('Booking created')
            ->success()
            ->body('Booking created successfully.')
            ->duration(5000)
            ->send();

        return redirect()->route('booking');
    }

    public function render(): View
    {

        return view('livewire.bookings.bookingForms.reviewBookings');
    }
}
