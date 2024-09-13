<?php

namespace App\Livewire\Bookings\EditBookingForms;

use App\Models\Booking;
use Filament\Notifications\Notification;
use App\Models\Property;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Carbon\Carbon;
use Filament\Actions\EditAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class EditBookingSettingsForm extends Component implements HasForms
{
    /**
     * Retoune le formulare de add booking
     *
     * @return form
     */
    use InteractsWithForms;

    public $settingData = [];
    public $bookingId;

    public $booking;

    public function mount($bookingId): Void
    {
        $this->bookingId = $bookingId;
        $this->booking = Booking::findOrFail($bookingId);
        // dd($property);
        // $property = Property::find($this->booking->property_id);
        // $property_attribute = PropertyAttribute::find($property->property_attribute_id);

        $this->form->fill([
            'property_id' => $this->booking->property_id,
            'check_in' => $this->booking->check_in,
            'check_out' => $this->booking->check_out,
            'number_of_adults' => $this->booking->number_of_adults,
            'number_of_children' => $this->booking->number_of_children,
            'number_of_animals' => $this->booking->number_of_animals,
        ]);
    }

    public function form(Form $form): Form
    {

        $property = Property::all()->pluck('attribute.name', 'id')->toArray();
        $today = Carbon::today()->format('Y-m-d');

        return $form->schema([
            Section::make()->schema([
                Select::make('property_id')
                    ->label('Property')
                    ->columnSpanFull()
                    ->disabled()
                    ->options($property)
                    ->native(false),
                // ->required(),

                DatePicker::make('check_in')
                    ->label('Check-in')
                    ->minDate($today)
                    ->reactive()
                    ->columns(1),
                // ->required(),

                DatePicker::make('check_out')
                    ->after('check_in')
                    ->live()
                    ->minDate(fn($get) => $get('check_in'))
                    ->label('Check-out'),
                // ->required(),

                Fieldset::make('Number of guests')
                    ->schema([
                        TextInput::make('number_of_adults')
                            ->label('Adults')
                            ->prefixIcon('heroicon-s-user-group')
                            ->numeric(),

                        TextInput::make('number_of_children')
                            ->label('Children')
                            ->prefixIcon('heroicon-s-user-group')
                            ->numeric(),

                        TextInput::make('number_of_animals')
                            ->label('Animals')
                            ->reactive()
                            ->prefixIcon('heroicon-s-user-group')
                            ->numeric(),
                    ])->columns(6),
            ])->columns(2),
        ])->statePath('settingData');
        // ->model($this->booking);
    }

    public function get_number_of_nights()
    {
        // Calcule du nombre de nuits
        $check_in = Carbon::parse($this->settingData['check_in']);
        $check_out = Carbon::parse($this->settingData['check_out']);
        $number_of_nights = $check_in->diffInDays($check_out) + 1;
        return $number_of_nights;
    }

    public function updateBooking()
    {

        $number_of_guests = $this->settingData['number_of_adults'] + $this->settingData['number_of_children'];
        $number_of_nights = $this->get_number_of_nights();

        // Mettre à jour la réservation
        $this->booking->update([
            'number_of_guests' => $number_of_guests,
            'number_of_nights' => $number_of_nights,
            'check_in' => $this->settingData['check_in'],
            'check_out' => $this->settingData['check_out'],
            'number_of_adults' => $this->settingData['number_of_adults'],
            'number_of_children' => $this->settingData['number_of_children'],
            'number_of_animals' => $this->settingData['number_of_animals'],
        ]);

        Notification::make()
            ->title('Booking settings updated')
            ->success()
            ->body('Booking settings updated successfully.')
            ->duration(5000)
            ->send();
    }

    public function cancel()
    {

        $this->form->fill([
            'property_id' => $this->booking->property_id,
            'check_in' => $this->booking->check_in,
            'check_out' => $this->booking->check_out,
            'number_of_adults' => $this->booking->number_of_adults,
            'number_of_children' => $this->booking->number_of_children,
            'number_of_animals' => $this->booking->number_of_animals,
        ]);
    }

    public function render(): View
    {
        return view('livewire.bookings.editBookingForms.editBookingSettings-form');
    }
}
