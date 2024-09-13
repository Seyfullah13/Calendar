<?php

namespace App\Livewire\Bookings\BookingForms;

use App\Models\Booking;
use App\Models\BookingGuest;
use App\Models\Currency;
use App\Models\Property;
use App\Models\PropertyAttribute;
use Carbon\Carbon;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class PricingForm extends Component implements HasForms
{
    /**
     * Retoune le formulare de add booking
     *
     * @return array $schema
     */
    use InteractsWithForms;

    public $priceData = [];
    public $settingData = []; // tableau pour récupérer les données du composant BookingSettings
    public $guestData = []; // tableau pour récupérer les données du composant GuestInformation

    public $night_price;
    public $cleaning_fee = 0;
    public $additional_fee_coust = 0;
    public $estimated_taxes = 0;
    public $total_cost = 0;
    public $base_price;

    public $number_of_nights = 0;

    public $isSaved = false;

    public $property;

    // Listener pour écouter les évenements des autres composants
    protected $listeners = [
        'settingDataSubmitted' => 'hundleSettingData', // Les données venants du composant bookingSettings
        'guestDataSubmitted' => 'hundleGuestData', // Les données venants du composant bookingGuest
    ];

    
    public function mount(): Void
    {
        $this->pricingForm->fill();
    }

    public function hundleSettingData($settingData)
    {
        $this->settingData = $settingData;
        $this->number_of_nights = $this->get_number_of_nights();

        $this->property = Property::find($this->settingData['property_id']);
        $this->base_price = $this->property->base_price;
        $this->night_price = $this->base_price;
        $this->total_cost = $this->night_price * $this->number_of_nights;

        $this->mount(); 
    }

    public function hundleGuestData($guestData)
    {
        $this->guestData = $guestData;
        // dd($this->night_price);
    }

    public function get_number_of_nights()
    {
        // Calcule du nombre de nuits
        $check_in = Carbon::parse($this->settingData['check_in']);
        $check_out = Carbon::parse($this->settingData['check_out']);
        $number_of_nights = $check_in->diffInDays($check_out);
        return $number_of_nights;
    }


    public function calculateTotalCost()
    {
        $this->total_cost = $this->night_price + $this->cleaning_fee + $this->additional_fee_coust
            + $this->estimated_taxes;
    }

    public function getForms(): array
    {
        return [
            'pricingForm',
        ];
    }

    public function pricingForm(Form $form): Form
    {
        return Form::make($this)->schema([
            Section::make()->schema([
                Select::make('type_of_payement')
                    ->label('Type of payement')
                    ->options([
                        'manualprice' => 'Manual price',
                        'calculatedprice' => 'Caculated price'
                    ])
                    ->native(false)
                    ->default('manualprice')
                    ->reactive()
                    ->helperText('Your current rate is calculated below for reference. Adjust values in the Quote column to customize your Quote.')
                    ->columnSpanFull(),
                Section::make()->schema([

                    Grid::make(3)->schema([

                        ViewField::make('item')
                            ->view('forms.components.custom-text-field')
                            ->label('Item')
                            ->default(fn($get) => $this->base_price . '*' . $this->number_of_nights . ' nights')
                            ->disabled(),

                        ViewField::make('current_rates')
                            ->view('forms.components.custom-text-field')
                            ->label('Current rates')
                            ->default('€'.$this->base_price * $this->number_of_nights)
                            ->disabled(),

                        TextInput::make('night_price')
                            ->label('Quote')
                            ->prefix('€')
                            ->default($this->base_price * $this->number_of_nights)
                            ->numeric()
                            ->inputMode('decimal')
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                // Calcul du nombre de nuits à partir de la date d'arrivée et de la date de départ
                                $this->night_price = $state;
                                $set('current_rates', '€' . $state);
                                $this->total_cost = $this->night_price + $this->cleaning_fee + $this->additional_fee_coust
                                    + $this->estimated_taxes;
                                $set('total_payout', number_format($this->total_cost, 2));
                                $set('total_payout_view', '€' . number_format($this->total_cost, 2));
                                $this->calculateTotalCost();
                            }),
                    ]),
                    Grid::make(3)->schema([
                        // Label
                        ViewField::make('cleaning_fee_label')
                            ->view('forms.components.custom-text-field')
                            ->label('Cleaning Fee')
                            ->disabled(),
                        // Affichage du prix
                        ViewField::make('cleaning_fee_view')
                            ->view('forms.components.custom-text-field')
                            ->hiddenLabel()
                            ->default('€' . $this->cleaning_fee)
                            ->disabled(),
                        // Modifier le prix
                        TextInput::make('cleaning_fee')
                            ->hiddenLabel()
                            ->prefix('€')
                            ->numeric()
                            ->inputMode('decimal')
                            ->default($this->cleaning_fee)
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                // Calcul du nombre de nuits à partir de la date d'arrivée et de la date de départ
                                $this->cleaning_fee = $state;
                                $set('cleaning_fee_view', '€' . $state);
                                $this->total_cost = $this->night_price + $this->cleaning_fee + $this->additional_fee_coust
                                    + $this->estimated_taxes;
                                    $set('total_payout', number_format($this->total_cost, 2));
                                    $set('total_payout_view', '€' . number_format($this->total_cost, 2));
                                $this->calculateTotalCost();
                            }),
                    ]),
                    Grid::make(2)->schema([
                        TextInput::make('additional_fee_or_discount')
                            ->label('')
                            ->placeholder('Additional fee or discount')
                            ->suffixIcon('heroicon-s-plus'),
                        TextInput::make('additional_fee_coust')
                            ->label('')
                            ->inlineLabel()
                            ->prefix('€')
                            ->default(0)
                            ->numeric()
                            ->live()
                            ->afterStateUpdated(function ($state, $set) {
                                // Calcul du nombre de nuits à partir de la date d'arrivée et de la date de départ
                                $this->additional_fee_coust = $state;
                                $this->total_cost = $this->night_price + $this->cleaning_fee + $this->additional_fee_coust
                                    + $this->estimated_taxes;
                                    $set('total_payout', number_format($this->total_cost, 2));
                                    $set('total_payout_view', '€' . number_format($this->total_cost, 2));
                                $this->calculateTotalCost();
                            }),
                    ]),

                    Grid::make(2)->schema([
                        ViewField::make('estimated_taxes_view')
                            ->view('forms.components.custom-text-field')
                            ->inlineLabel()
                            ->label('Estimated taxes')
                            ->default($this->estimated_taxes)
                            ->disabled(),

                        ViewField::make('estimated_taxes')
                            ->view('forms.components.custom-text-field')
                            ->label(' ')
                            ->inlineLabel()
                            ->default(fn() => '€' . number_format(
                                $this->estimated_taxes,
                                2
                            ))
                            ->disabled()
                            ->afterStateUpdated(fn($state) => $this->estimated_taxes = $state),
                    ]),
                ]),
                Grid::make(2)->schema([
                    ViewField::make('total_payout_view')
                        ->view('forms.components.custom-text-field')
                        ->inlineLabel()
                        ->label('Total cost to guest')
                        ->default(fn() => '€' . number_format($this->total_cost, 2))
                        ->disabled(),
                    ViewField::make('total_payout')
                        ->view('forms.components.custom-text-field')
                        ->inlineLabel()
                        ->label(' ')
                        ->reactive()
                        ->default(number_format($this->total_cost, 2))
                        ->disabled(),
                ]),
                Select::make('hold_booking')
                    ->label('How long would you like to hold the booking?')
                    ->required()
                    ->options([
                        '24' => '24 yours',
                        '48' => '48 hours',
                        '72' => '72 hours',
                    ])
                    // ->default(24)
                    ->native(false)
                    ->helperText('If the quote expires before payment is received, InnovRental will unblock the dates. The guest can still use the link to book as long as the dates remain available.')
                    ->hidden(fn($get) => $get('type_of_payement') === 'manualprice')
                    ->columnSpan(2),
            ])->columns(3),

        ])->statePath('priceData');
    }

    public function resetRate()
    {
        $this->night_price = $this->base_price * $this->number_of_nights;
        $this->total_cost = $this->base_price * $this->number_of_nights;
        $this->cleaning_fee = 0;
        $this->pricingForm->fill();
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

        $booking->preparation_time = Carbon::now()->format('H:i:s');
        $booking->property_id = $property->id;
        $booking->check_in = $settingData['check_in'];
        $booking->check_out = $settingData['check_out'];
        $booking->number_of_nights = $this->number_of_nights;
        $booking->number_of_children = $settingData['number_of_children'];
        $booking->number_of_adults = $settingData['number_of_adults'];
        $booking->number_of_animals = $settingData['number_of_animals'];
        $booking->number_of_guests = $settingData['number_of_adults'] + $settingData['number_of_children'];
        $booking->booked_at = now();
        $booking->booking_guest_id = $bookingGuest->id;
        $booking->note = $guestData['note'] ?? '';
        $booking->total_taxes = $this->estimated_taxes ?? 0;
        $booking->total_payout = $this->total_cost;
        $booking->total_fees = 0;
        $booking->booking_status_id = 3; // Status confirmé
        $booking->save();

        Notification::make()
            ->title('Booking created')
            ->success()
            ->body('Booking created successfully.')
            ->duration(5000)
            ->send();

        $this->pricingForm->fill();
        return redirect()->route('booking');
    }

    public function sendData(): Void
    {
        // Envoyer les données pour afficher sur la page sur la page résumé
        $this->validate([
            'priceData.hold_booking' => 'required',
        ]);
        $this->isSaved = true;
        $this->dispatch('priceDataDisplay', $this->priceData);
    }

    public function render(): View
    {
        return view('livewire.bookings.bookingForms.pricing-form');
    }
}
