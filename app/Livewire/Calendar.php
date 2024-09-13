<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Partenaire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\BookingGuest;
use App\Models\BookingStatus;
use App\Livewire\FullCalendar;
use Carbon\Carbon;
class Calendar extends Component
{
  public $events = [];
  public $resources = [];

  protected $listeners = [
    'refreshEvents' => 'loadEvents'
  ];

  public function mount()
  {
    $this->loadEvents();
    $this->loadResources();
  }

  public function loadEvents()
  {
      // Clear the events array
      $this->events = [];
      $user = Auth::user();

      $confirmed = BookingStatus::where('name', 'Confirmé')->first();

      // Récupérer les données de réservation avec les relations nécessaires
      $bookings = Booking::with(['guest', 'partenaire', 'property.attribute'])
                         ->where('booking_status_id', $confirmed->id)
                         ->get();

      foreach ($bookings as $booking) {

                          $guestFirst_name = $booking->guest->first_name ?? null;
                          $guestLast_name = $booking->guest->last_name ?? null;

                          $guestName = ($guestFirst_name ?? '') . ' ' . ($guestLast_name ?? '');
                          $guestName = trim($guestName) ?: 'N/A';

                          $partenaire = $booking->partenaire;

                    // Créer un tableau associatif représentant un événement dans FullCalendar
                    $event = [
                      'id' => $booking->id,
                      'title' => $guestName,
                      'start' => $booking->check_in,
                      'end' => $booking->check_out,
                      'allDay' => false,
                      'resourceId' => $booking->property_id,
                      'slotEventOverlap' => false,
                      'borderColor' => $partenaire->border_color ?? null,
                      'backgroundColor' => $partenaire->background_color ?? null,
                      'extendedProps' => [
                        'guestId' => $booking->guest->id ?? null,
                        'guest' => $guestName,
                        'partnerId' => $partenaire->id ?? null,
                        'partnerName' => $partenaire->name ?? null,
                        'partnerIcon' => $partenaire->icon ?? null,
                        'number_of_nights' => $booking->number_of_nights,
                        'number_of_guests' => $booking->number_of_guests,
                        'number_of_adults' => $booking->number_of_adults,
                        'number_of_children' => $booking->number_of_children,
                        'number_of_animals' => $booking->number_of_animals,
                        'property' => $booking->property->attribute->name,
                        'total_payout' => $booking->total_payout,
                        'currency' => $booking->currency,
                        'email' => $booking->guest->email ?? null,
                        'phone' => $booking->guest->phone ?? null,
                        'picture' => $booking->guest->picture ?? null,
                        'external' => $booking->external_reservation_id,
                      ]
                    ];

                    // Ajouter l'événement formaté à la liste des événements
                    $this->events[] = $event;
                  }

        // Dates réservées
        $reservedDates = getReservedDates();
        //dd($reservedDates);

        // Dates pour six mois à venir
        $dates6months = getNextSixMonthsDates();

        $properties = $user->userRoles->pluck('property')->where('is_enabled', true);


          foreach ($dates6months as $dates6month) {
            foreach($properties as $property){

              if (!in_array($dates6month, $reservedDates)) {
                  $event = [
                    'title' => 100,
                    'start' => $dates6month,
                    'end' => $dates6month,
                    'price' => 100, // Assurez-vous de définir $price
                    'resourceId' => $property->id,

                  ];
                  $this->events[] = $event;
              }
            }
        }

  }


  public function loadResources()
  {
    // Clear the resources array
    $this->resources = [];

    // Récupérer les propriétés de l'utilisateur connecté
    $user = Auth::user();
    $properties = $user->userRoles->pluck('property')->where('is_enabled', true);

        foreach ($properties as $property) {
            // Assurez-vous de récupérer correctement la photo avec photo_id 1
            $photo = $property->first_photo_url;

            // Si la photo existe, utilisez son chemin, sinon utilisez un chemin par défaut
            $imagePath = './storage/'.$photo ?? './storage/avatars/defaultHome.jpg';

            $resource = [
                'id' => $property->id,
                'title' => $property->attribute->name,
                'building' => $property->attribute->nickname,
                'image' => $imagePath
            ];

            $this->resources[] = $resource;
        }
    }

    public function getEvents()
    {
        $this->loadEvents();
        return response()->json($this->events);
    }

  public function render()
  {
    return view('livewire.calendar', [
      'hasProperties' => !empty($this->resources)
    ]);
  }

  public function updatePhone(Request $request)
  {
    $validatedData = $request->validate([
      'id' => 'required|integer|exists:booking_guests,id',
      'phone' => 'required|string|max:15',
    ]);

    try {
      $guest = BookingGuest::findOrFail($validatedData['id']);
      $guest->phone = $validatedData['phone'];
      $guest->save();

      $this->emit('refreshEvents');

      return response()->json(['success' => true]);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
  }

  public function updateEmail(Request $request)
  {
    $validatedData = $request->validate([
      'id' => 'required|integer|exists:booking_guests,id',
      'email' => 'required|string|email|max:255',
    ]);

    try {
      $guest = BookingGuest::findOrFail($validatedData['id']);
      $guest->email = $validatedData['email'];
      $guest->save();



      return response()->json(['success' => true]);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
  }


  public function updateArivalTime(Request $request)
  {



    $newArivalTime = $request->arivalTime;  // Format: 'HH:MM'
    $bookingId = $request->id;




    try {
      // Récupérer la réservation
      $booking = Booking::findOrFail($bookingId);

      // Récupérer la date actuelle de check-in
      $currentCheckIn = new \DateTime($booking->check_in);

      // Créer un nouvel objet DateTime avec la date actuelle et la nouvelle heure
      list($hour, $minute) = explode(':', $newArivalTime);
      $currentCheckIn->setTime($hour, $minute);

      // Mettre à jour le check-in avec la nouvelle date et heure
      $booking->check_in = $currentCheckIn->format('Y-m-d H:i:s');
      $booking->save();

      return response()->json(['success' => true]);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
  }

  public function updateDeparturTime(Request $request)
  {



    $newDeparturTime = $request->departurTime;  // Format: 'HH:MM'
    $bookingId = $request->id;




    try {
      // Récupérer la réservation
      $booking = Booking::findOrFail($bookingId);

      // Récupérer la date actuelle de check-in
      $currentCheckOut = new \DateTime($booking->check_out);

      // Créer un nouvel objet DateTime avec la date actuelle et la nouvelle heure
      list($hour, $minute) = explode(':', $newDeparturTime);
      $currentCheckOut->setTime($hour, $minute);

      // Mettre à jour le check-in avec la nouvelle date et heure
      $booking->check_Out = $currentCheckOut->format('Y-m-d H:i:s');
      $booking->save();

      return response()->json(['success' => true]);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
  }
  public function updateArrivalDate(Request $request)
  {
    $newArrivalDate = $request->arrivalDate;  // Format: 'YYYY-MM-DD'
    $bookingId = $request->id;

    try {
      // Récupérer la réservation
      $booking = Booking::findOrFail($bookingId);

      // Récupérer la date actuelle de check-in
      $currentCheckIn = new \DateTime($booking->check_in);

      // Créer un nouvel objet DateTime avec la nouvelle date et l'heure actuelle
      $newArrivalDateTime = new \DateTime($newArrivalDate . ' ' . $currentCheckIn->format('H:i:s'));

      // Mettre à jour le check-in avec la nouvelle date et heure actuelle
      $booking->check_in = $newArrivalDateTime->format('Y-m-d H:i:s');
      $booking->save();

      return response()->json(['success' => true]);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
  }

  public function updateDepartureDate(Request $request)
  {
    $newDepartureDate = $request->departureDate;  // Format: 'YYYY-MM-DD'
    $bookingId = $request->id;

    try {
      // Récupérer la réservation
      $booking = Booking::findOrFail($bookingId);

      // Récupérer la date actuelle de check-in
      $currentCheckOut = new \DateTime($booking->check_out);

      // Créer un nouvel objet DateTime avec la nouvelle date et l'heure actuelle
      $newDepartureDateTime = new \DateTime($newDepartureDate . ' ' . $currentCheckOut->format('H:i:s'));

      // Mettre à jour le check-in avec la nouvelle date et heure actuelle
      $booking->check_out = $newDepartureDateTime->format('Y-m-d H:i:s');
      $booking->save();

      return response()->json(['success' => true]);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
  }





  }

// Récupération des dates de réservations
function getReservedDates() {
    // On récupère toutes les dates de check-in et check-out
    $bookings = Booking::select('check_in', 'check_out')->get();
    $reservedDates = [];

    foreach ($bookings as $booking) {
        $checkIn = new \DateTime($booking->check_in);
        $checkOut = new \DateTime($booking->check_out);

        // Ajouter chaque jour de la période de réservation
        while ($checkIn <= $checkOut) {
            $reservedDates[] = $checkIn->format('Y-m-d H:m:s');
            $checkIn->modify('+1 day');
        }
    }

    // Retourner les dates réservées sans doublons
    return array_values(array_unique($reservedDates));
}

// Générer les dates des 6 prochains mois
function getNextSixMonthsDates() {
    $dates = [];
    $startDate = new \DateTime();
    $endDate = (clone $startDate)->modify('+6 months');

    // Ajouter chaque jour à partir d'aujourd'hui jusqu'à la date dans 6 mois
    while ($startDate <= $endDate) {
        $dates[] = $startDate->format('Y-m-d H:m:s');
        $startDate->modify('+1 day');
    }

    return $dates;
}

// Créer un événement
function createEvent($date, $price) {
    return [
        'title' => 'Événement disponible',
        'start' => $date,
        'end' => $date,
        'price' => $price
    ];
}

// Attribuer un prix à un événement
function assignPriceToEvent() {
    // Retourne un prix aléatoire entre 100 et 200
    return random_int(100, 200);
}

// Créer des événements pour les dates disponibles
function createEventsForAvailableDates() {
    $reservedDates = getReservedDates();
    $dates = getNextSixMonthsDates();
    // Créer un tableau d'événements
    $events = [];
    // Vérifier chaque date et créer un événement si elle est disponible
    foreach ($dates as $date) {
        if (!in_array($date, $reservedDates)) {
            $event = createEvent($date, assignPriceToEvent());
            $events[] = $event;
        }
    }
    return $events;
}

// Appeler la fonction pour créer les événements
$events = createEventsForAvailableDates();

// Encoder les événements en JSON pour une utilisation ultérieure
$eventsJson = json_encode($events);
