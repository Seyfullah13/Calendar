<?php

namespace App\Livewire\Bookings\BookingForms;

use App\Models\BookingGuest;
use Livewire\Component;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class GuestInformationForm extends Component implements HasForms
{
    /**
     * Retoune le formulare de add booking
     *
     * @return array $schema
     */

    use InteractsWithForms;

    public $isSaved = false;
    public $guestData = [];

    protected function rules()
    {
        return [
            'guestData.first_name' => ['required'],
            'guestData.last_name' => ['required'],
            'guestData.email' => ['required', 'email'],
        ];
    }

    public function mount(): Void
    {
        $this->guestInformationForm->fill();
    }

    public function getForms(): array
    {
        return [
            'guestInformationForm',
        ];
    }

    public function guestInformationForm(Form $form): Form
    {
        return $form->schema([

            Section::make()->schema([
                Section::make()->schema([
                    Select::make('guest_id')
                        ->label('Select an existing guest')
                        ->options(BookingGuest::all()->mapWithKeys(function ($guest) {
                            return [$guest->id => $guest->first_name . ' ' . $guest->last_name];
                        }))
                        ->native(false)
                        ->reactive()
                        ->searchable()
                        ->afterStateUpdated(function ($state, $set) {

                            $guest = BookingGuest::find($state);
                            $set('first_name', $guest->first_name);
                            $set('last_name', $guest->last_name);
                            $set('email', $guest->email);
                            $set('phone', $guest->phone);
                        }),
                ]),

                TextInput::make('first_name')
                    ->label('First Name')
                    ->placeholder('First Name')
                    ->extraAttributes(['id' => 'first_name'])
                    ->required(),
                TextInput::make('last_name')
                    ->label('Last Name')
                    ->placeholder('Last Name')
                    ->extraAttributes(['id' => 'last_name'])
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->placeholder('Guest mail')
                    ->columnSpanFull(),
                PhoneInput::make('phone')
                    ->label('Phone')
                    // ->required()
                    ->displayNumberFormat(PhoneInputNumberType::INTERNATIONAL)
                    ->defaultCountry('FR'),
                Textarea::make('note')
                    ->placeholder('Write your test here')
                    ->rows(5)
                    ->columnSpanFull(),

            ])->columns(2),
        ])->statePath('guestData');
    }

    public function updated($propertyName)
    {
        // Réinitialiser l'état de sauvegarde si une modification est apportée
        $this->isSaved = false;
    }

    public function sendData()
    {
        // Cette méthode permet de d'envoyer les données du composant aux autres composants
        $this->validate();
        $this->isSaved = true;
        $this->dispatch('guestDataSubmitted', $this->guestData);
    }

    public function render(): View
    {
        return view('livewire.bookings.bookingForms.guestInformation-form');
    }
}
