<?php

namespace App\Livewire\Bookings\EditBookingForms;

use App\Models\Booking;
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
use Livewire\Component;

class EditPricingForm extends Component implements HasForms
{
    /**
     * Retoune le formulare de add booking
     *
     * @return array $schema
     */
    use InteractsWithForms;

    public $priceData = [];

    public $night_price = 0;
    public $cleaning_fee = 0;
    public $additional_fee_coust = 0;
    public $estimated_taxes = 0;
    public $total_cost = 0;
    private $total_fee = 0;

    public $booking;
    public $bookingId;

    public function mount($bookingId): Void
    {
        $this->bookingId = $bookingId;
        $this->booking = Booking::findOrFail($bookingId);

        $this->night_price = $this->booking->total_payout;
        $this->additional_fee_coust = 0;
        $this->estimated_taxes = 0;
        $this->total_cost = 0;
        $this->total_fee = 0;

        $this->form->fill([
            "night_price" => $this->booking->total_payout,
            "current_rates" => $this->booking->total_payout,
            "cleaning_fee" => 0,
            "total_payout" => $this->booking->total_payout,
            "total_taxes" => $this->booking->total_taxes,
            "total_fee" => $this->booking->total_fee,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([

                Section::make()->schema([

                    Grid::make(3)->schema([

                        ViewField::make('item')
                            ->view('forms.components.custom-text-field')
                            ->label('Item')
                            ->default('Booking price')
                            ->disabled(),

                        ViewField::make('current_rates')
                            ->view('forms.components.custom-text-field')
                            ->label('Current rates')
                            ->disabled(),

                        TextInput::make('night_price')
                            ->label('Quote')
                            ->prefix('€')
                            ->numeric()
                            ->inputMode('decimal')
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                // Calcul du nombre de nuits à partir de la date d'arrivée et de la date de départ
                                $this->night_price = $state;
                                $set('current_rates', '€' . $state);
                                $this->total_cost = $this->night_price + $this->cleaning_fee + $this->additional_fee_coust
                                    + $this->estimated_taxes;
                                $set('total_payout', '€' . $this->total_cost);
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
                            ->disabled(),
                        // Modifier le prix
                        TextInput::make('cleaning_fee')
                            ->hiddenLabel()
                            ->prefix('€')
                            ->numeric()
                            ->inputMode('decimal')
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                // Calcul du nombre de nuits à partir de la date d'arrivée et de la date de départ
                                $this->cleaning_fee = $state;
                                $set('cleaning_fee_view', '€' . $state);
                                $this->total_cost = $this->night_price + $this->cleaning_fee + $this->additional_fee_coust
                                    + $this->estimated_taxes;
                                $set('total_payout', '€' . $this->total_cost);

                                $this->total_fee = $this->cleaning_fee + $this->additional_fee_coust;
                                $set('total_fee', $this->total_fee);
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
                            ->numeric()
                            ->inputMode('decimal')
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                // Calcul du nombre de nuits à partir de la date d'arrivée et de la date de départ
                                $this->additional_fee_coust = $state;
                                $this->total_cost = $this->night_price + $this->cleaning_fee + $this->additional_fee_coust
                                    + $this->estimated_taxes;
                                $set('total_payout', '€' . $this->total_cost);

                                $this->total_fee = $this->cleaning_fee + $this->additional_fee_coust;
                                $set('total_fee', $this->total_fee);
                            }),
                    ]),

                    Grid::make(2)->schema([
                        ViewField::make('estimated_taxes_view')
                            ->view('forms.components.custom-text-field')
                            ->inlineLabel()
                            ->label('Estimated taxes')
                            ->disabled(),

                        ViewField::make('estimated_taxes')
                            ->view('forms.components.custom-text-field')
                            ->label(' ')
                            ->inlineLabel()
                            ->disabled()
                            ->afterStateUpdated(fn($state) => $this->estimated_taxes = $state),
                    ]),
                ]),
                Grid::make(2)->schema([
                    ViewField::make('total_payout')
                        ->view('forms.components.custom-text-field')
                        ->inlineLabel()
                        ->label('Total cost to guest')
                        ->disabled(),
                    ViewField::make('total_payout')
                        ->view('forms.components.custom-text-field')
                        ->inlineLabel()
                        ->label(' ')
                        ->reactive()
                        ->disabled(),
                ]),
            ])->columns(3),

        ])->statePath('priceData');
    }

    public function updateBooking()
    {

        // dd($this->total_cost);
        // Mettre à jour les informations du client
        $this->booking->update([
            'total_payout' => $this->total_cost,
            'total_taxes' => $this->priceData['total_taxes'],
            'total_fee' => $this->priceData['total_fee'],
        ]);

        Notification::make()
            ->title('Pricing updated')
            ->success()
            ->body('Pricing updated successfully.')
            ->duration(5000)
            ->send();
    }

    public function cancel()
    {
        $this->form->fill([
            "night_price" => $this->booking->total_payout,
            "current_rates" => $this->booking->total_payout,
            "cleaning_fee" => 0,
            "total_payout" => $this->booking->total_payout,
            "total_taxes" => $this->booking->total_taxes,
            "total_fee" => $this->booking->total_fee,
        ]);
    }

    public function render(): View
    {
        return view('livewire.bookings.editBookingForms.editPricing-form');
    }
}
