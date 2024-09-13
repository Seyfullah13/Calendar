<?php

namespace App\Livewire\Bookings\BookingForms;

use App\Models\Booking;
use App\Models\Property;
use App\Models\PropertyAttribute;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Carbon\Carbon;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;
use Illuminate\Support\Facades\Log;
use DateTime;

class BookingSettingsForm extends Component implements HasForms
{

    use InteractsWithForms;

    public $block = false;
    public $isSaved = false;
    public $number_of_nights = 0;
    public $settingData = [];
    

    
    public function mount(): Void
    {
        $this->bookingSettingsForm->fill();
    }

    public function getForms(): array
    {
        return [
            'bookingSettingsForm',
        ];
    }

    protected function rules()
    {
        return [
            'settingData.property_id' => ['required', 'exists:properties,id'],
            'settingData.check_in' => ['required', 'date'],
            'settingData.check_out' => ['required', 'date', 'after_or_equal:settingData.check_in'],
            // Ajoutez d'autres règles si nécessaire
        ];
    }

    public function bookingSettingsForm(Form $form): Form
    {
        $user = Auth::user();

        $property = Property::where('is_enabled', true)
            ->whereHas('userRoles', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with('attribute')  // Charger la relation 'attribute'
            ->get()
            ->pluck('attribute.name', 'id')  // Pluck à partir des résultats chargés en mémoire
            ->toArray();

        //$property = Property::all()->pluck('attribute.name', 'id')->toArray();

        $today = Carbon::today()->format('Y-m-d');

        return $form->schema([
            Section::make()->schema([
                Select::make('property_id')
                    ->label('Property')
                    ->columnSpanFull()
                    ->reactive()
                    ->options($property)
                    ->afterStateUpdated(function (callable $set, $state) {
                        $set('settingData.property_id', $state);
                        $set('test_field', null);
                    })
                    ->required(),
                
               // Champ DateRangePicker caché au début et qui apparaît lorsqu'une propriété est sélectionnée
               DateRangePicker::make('reservation_plage')
               ->label('Check-in / Check_out')
               ->columnSpanFull()
               ->minDate($today)
               ->required()
               ->disabledDates(function ($get) {
                   $propertyId = $get('property_id');

                   if (!$propertyId) {
                       return [];
                   }
           
                   // Récupérer les dates réservées pour la propriété sélectionnée
                   $reservedDates = $this->getReservedDates($propertyId);
                      
                   return $reservedDates;
               })
               ->hidden(fn ($get) => empty($get('property_id')))
               ->disableClear()
               ->format('Y-m-d'),
               
                
                // DatePicker::make('check_in')
                //     ->label('Check-in')
                //     ->minDate($today)
                //     ->reactive()
                //     ->columns(1)
                //     ->native(false)
                //     ->required()
                //     ->disabledDates(function ($get) {
                //         $propertyId = $get('property_id');
                //         if (!$propertyId) {
                //             return []; // Retourner un tableau vide si aucune propriété n'est sélectionnée
                //         }
                
                //         // Appel à la méthode pour obtenir les dates réservées
                //         $reservedDates = $this->getReservedDates($propertyId);
                
                //         // Retourner les dates au bon format
                //         return $reservedDates;
                //     }),

                // DatePicker::make('check_out')
                //     ->after('check_in')
                //     ->reactive()
                //     ->minDate(fn($get) => $get('check_in'))
                //     ->afterStateUpdated(function ($state, $get) {
                //         // Calcul du nombre de nuits à partir de la date d'arrivée et de la date de départ 
                //         $checkIn = $get('check_in');
                //         $checkOut = $state;
                //         $numberOfNights = (new \DateTime($checkIn))->diff(new \DateTime($checkOut))->days;
                //         $this->number_of_nights = $numberOfNights;
                //     })
                //     ->label('Check-out')
                //     ->required(),

                Toggle::make('block')
                    ->label('Mark as blocked')
                    ->onIcon('heroicon-m-lock-closed')
                    ->offIcon('heroicon-m-lock-open')
                    ->onColor('info')
                    ->reactive()
                    ->inline(false)
                    ->afterStateUpdated(fn($state) => $this->block = $state),
                Textarea::make('note')
                    ->label('Note')
                    ->columnSpanFull()
                    ->rows(6)
                    ->hidden(fn($get) => $get('block') === false)
                    ->placeholder('Write the reason why the property in blocked'),

                Fieldset::make('Number of guests')
                    ->hidden(fn($get) => $get('block') == true)
                    ->schema([
                        TextInput::make('number_of_adults')
                            ->label('Adults')
                            ->default(1)
                            ->minValue(1)
                            ->prefixIcon('heroicon-s-user-group')
                            ->numeric(),

                        TextInput::make('number_of_children')
                            ->label('Children')
                            ->default(0)
                            ->minValue(0)
                            ->prefixIcon('heroicon-s-user-group')
                            ->numeric(),

                        TextInput::make('number_of_animals')
                            ->label('Animals')
                            ->default(0)
                            ->minValue(0)
                            ->prefixIcon('heroicon-s-user-group')
                            ->numeric(),
                    ])->columns(6),
            ])->columns(2),
        ])->statePath('settingData');
    }

    // public function getReservedDates($propertyId)
    // {
    //     if (!$propertyId) {
    //         return [];
    //     }

    //     // Récupérer les dates réservées pour la propriété sélectionnée
    //     $reservedDates = Booking::where('property_id', $propertyId)
    //         ->select('check_in', 'check_out')
    //         ->get()
    //         ->flatMap(function ($booking) {
    //             $checkIn = new \DateTime($booking->check_in);
    //             $checkOut = new \DateTime($booking->check_out);
                
    //             $dates = [];
    //             while ($checkIn <= $checkOut) {
    //                 // Ajouter chaque date au tableau au format 'Y-m-d'
    //                 $dates[] = $checkIn->format('Y-m-d');
    //                 $checkIn->modify('+1 day');
    //             }
    //             return $dates;
    //         })
    //         ->toArray();
    //         Log::debug('Reserved Dates:', array_values(array_unique($reservedDates)));

    //     // Retourner les dates formatées comme un tableau de chaînes
    //     return array_values(array_unique($reservedDates));
    // }

    // public function getReservedDates($propertyId) {

    //     return ["2024-09-01", "2024-09-02", "2024-09-03"]; // Tester avec des données statiques ici aussi
    // }
    
    public function getReservedDates($propertyId)
    {
        if (!$propertyId) {
            return [];
        }

        $bookings = Booking::where('property_id', $propertyId)
        ->select('check_in', 'check_out')
        ->get();

        //dd($bookings);

        $reservedDates = [];

        foreach ($bookings as $booking) {
            $checkIn = new \DateTime($booking->check_in);
            $checkOut = new \DateTime($booking->check_out);

            // Ajouter les dates réservées pour cette réservation
            while ($checkIn <= $checkOut) {
                $reservedDates[] = $checkIn->format('Y-m-d');
                $checkIn->modify('+1 day');
            }
        }
        
        // Retourner les dates formatées comme un tableau de chaînes
        return array_values(array_unique($reservedDates));
    }


    public function sendData()
    {
        // Cette méthode permet de d'envoyer les données du composant aux autres composants
        $this->validate();
        $this->isSaved = true;
        $this->dispatch('settingDataSubmitted', $this->settingData);
    }

    public function updated($propertyName)
    {
        // Réinitialiser l'état de sauvegarde si une modification est apportée
        $this->isSaved = false;
    }

    public function create()
    {
        $property = Property::find($this->settingData['property_id']);

        $reservation_plage = $this->settingData['reservation_plage'];


        // Séparer les dates de check-in et check-out
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

        $booking = new Booking();

        $booking->property_id = $property->id;
        $booking->check_in = $formattedCheckIn;
        $booking->check_out = $formattedCheckOut;
        $booking->number_of_nights = $this->number_of_nights;
        $booking->number_of_children = 0;
        $booking->number_of_adults = 0;
        $booking->number_of_animals = 0;
        $booking->number_of_guests = 0;
        $booking->booking_status_id = 3; 
        $booking->note = $this->settingData['note'] ?? '';
        $booking->booked_at = now();

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
        return view('livewire.bookings.bookingForms.bookingSettings-form');
    }
}
