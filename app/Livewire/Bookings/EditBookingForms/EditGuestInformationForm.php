<?php

namespace App\Livewire\Bookings\EditBookingForms;

use App\Models\Booking;
use App\Models\BookingGuest;
use Livewire\Component;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class EditGuestInformationForm extends Component implements HasForms
{
    /**
     * Retoune le formulare de add booking
     *
     * @return array $schema
     */

    use InteractsWithForms;

    public ?array $guestData = [];
    public $bookingId;
    public $booking;
    public $bookingGuest;

    public function mount($bookingId): Void
    {
        $this->bookingId = $bookingId;
        $this->booking = Booking::findOrFail($bookingId);

        if ($this->booking->booking_guest_id) {
            $this->bookingGuest = BookingGuest::findOrFail($this->booking->booking_guest_id);
    
            $this->form->fill([
                "first_name" => $this->bookingGuest->first_name,
                "last_name" => $this->bookingGuest->last_name,
                "email" => $this->bookingGuest->email,
                "phone" => $this->bookingGuest->phone,
                "note" => $this->booking->note,
            ]);
        } else {
            // Si booking_guest_id est null, on remplit avec des valeurs par défaut
            $this->form->fill([
                "first_name" => "",
                "last_name" => "",
                "email" => "",
                "phone" => "",
                "note" => $this->booking->note, // Garder la note de la réservation si elle est présente
            ]);
        }

    }

    public function form(Form $form): Form
    {
        return $form->schema([
            
            Section::make()->schema([
               
                TextInput::make('first_name')
                    ->label('First Name'),
                
                TextInput::make('last_name')
                    ->label('Last Name'),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->columnSpanFull(),

                PhoneInput::make('phone')
                    ->label('Phone')
                    ->displayNumberFormat(PhoneInputNumberType::INTERNATIONAL), 

                Textarea::make('note')
                    ->placeholder('Write your test here')
                    ->rows(5)
                    ->columnSpanFull(),

            ])->columns(2),
        ])->statePath('guestData');
    }

    public function updateBooking(){
        
    
        // Mettre à jour les informations du client
        $this->bookingGuest->update([
            'first_name' => $this->guestData['first_name'],
            'last_name' => $this->guestData['last_name'],
            'email' => $this->guestData['email'],
            'phone' => $this->guestData['phone'],  
        ]);

        $this->booking->update([
            'note' => $this->guestData['note'],
        ]);

        Notification::make()
            ->title('Guest information updated')
            ->success()
            ->body('Guest information updated successfully.')
            ->duration(5000)
            ->send();
    }

    public function cancel() {
        $this->form->fill([
            "first_name" => $this->bookingGuest->first_name,
            "last_name" => $this->bookingGuest->last_name,
            "email" => $this->bookingGuest->email,
            "phone" => $this->bookingGuest->phone,
            "note" => $this->booking->note,
        ]);
    }

    public function render(): View
    {
        return view('livewire.bookings.editBookingForms.editGuestInformation-form');
    }
}
