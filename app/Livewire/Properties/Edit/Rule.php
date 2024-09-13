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

class Rule extends Component implements HasForms
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
        $this->ruleForm->fill($this->record->toArray());
                
    }

    protected function getForms(): array
    {
        return [
            'ruleForm',
        ];
    }


    public function ruleForm(Form $form): Form
    {
        $petsChecked = $this->record->attribute->pets ?? false;
        $smokingChecked = $this->record->attribute->smoking ?? false;
        $partyChecked = $this->record->attribute->party ?? false;

        return $form
            ->schema([
                (new CustomToggle('attribute.pets'))->isChecked($petsChecked)->label('Pets Allowed'),
                (new CustomToggle('attribute.smoking'))->isChecked($smokingChecked)->label('Smoking Allowed'),
                (new CustomToggle('attribute.party'))->isChecked($partyChecked)->label('Party Allowed'),
            ])
            ->statePath('data')
            ->model($this->record);
    }


    public function ruleCreate()
    {
        $data = $this->ruleForm->getState();

        $property = Property::find($this->record->id);

        $propertyAttribute = PropertyAttribute::find($property->property_attribute_id);

        $propertyAttribute->update($data['attribute']);


        Notification::make()
            ->title('Rules Saved successfully')
            ->success()
            ->duration(5000)
            ->persistent()
            ->send();

    }



    public function render(): View
    {
        return view('livewire.properties.edit.rule');
    }
}
