<?php

namespace App\Livewire\Properties\Edit;
use Illuminate\Support\Facades\Session;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

use App\Forms\Components\CustomToggle;

use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use JaOcero\RadioDeck\Forms\Components\RadioDeck;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use RalphJSmit\Filament\MediaLibrary\Forms\Components\MediaPicker;

use Filament\Notifications\Notification;

use Outerweb\FilamentImageLibrary\Filament\Forms\Components\ImageLibraryPicker;

use Filament\Support\Enums\IconSize;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\IconPosition;

use App\Models\PropertyAttribute;
use App\Models\Address;
use App\Models\Partenaire;
use App\Models\PropertyPartenaire;
use App\Models\Photo;

use App\Models\MyUserRole;
use App\Models\MyRole;

use App\Models\PropertyType;
use App\Models\Timezone;
use App\Models\Currency;
use App\Models\Country;


use Illuminate\Support\Facades\Auth;


use Filament\Forms\Components\ViewField;

class Platform extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Property $record;
    
    public $partenaires = [];

    public $photos = [];

    public $propertyId;


    public function mount($propertyId): void
    {
        $this->propertyId = $propertyId;

        $this->record = Property::with(['attribute', 'address', 'partenaires', 'photos'])->findOrFail($propertyId);

        $this->fillForms();

    }

    protected function fillForms(): void
    {
        $this->partenaires = $this->record->partenaires->pluck('id')->toArray();
                
    }

    protected function getForms(): array
    {
        return [
            'platformForm',
        ];
    }

    public function platformForm(Form $form): Form
    {
        return $form
            ->schema([
                CheckboxList::make('partenaires')
                    ->options(Partenaire::all()->pluck('name', 'id')->toArray())
                    ->hiddenLabel(),
            ])
            ->model($this->record);
    }

    public function platformCreate()
    {
        $data = $this->platformForm->getState();

        // Mettre à jour les partenaires associés à l'enregistrement courant
        $this->record->partenaires()->sync($data['partenaires']);

        Notification::make()
            ->title('Parteners Saved successfully')
            ->success()
            ->duration(5000)
            ->persistent()
            ->send();

    }

    public function render(): View
    {
        return view('livewire.properties.edit.platform');
    }
}
