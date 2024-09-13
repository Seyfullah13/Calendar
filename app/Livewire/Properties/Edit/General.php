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

class General extends Component implements HasForms
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
        $this->generalForm->fill($this->record->toArray());
                
    }

    protected function getForms(): array
    {
        return [
            'generalForm',
        ];
    }


    public function generalForm(Form $form): Form
    {  
         // Récupérez les types de propriétés avec leurs noms et icônes
         $propertyTypes = PropertyType::all();

         $options = $propertyTypes->pluck('name', 'id')->toArray();
         $icons = $propertyTypes->pluck('icon', 'id')->toArray();
         
 
         // Convertir les données JSON en tableau associatif
         $countries =  Country::all()->pluck('name', 'id')->toArray();

        return $form
            ->schema([
                RadioDeck::make('attribute.property_type_id')
                            ->label('Property Type')
                            ->options($options)
                            ->icons($icons)
                            ->iconSize(IconSize::Large) // Small | Medium | Large | (string - sm | md | lg)
                            ->iconSizes([ // Customize the values for each icon size
                                'sm' => 'h-12 w-12',
                                'md' => 'h-14 w-14',
                                'lg' => 'h-16 w-16',
                            ])
                            ->alignment(Alignment::Center) // Start | Center | End | (string - start | center | end)
                            ->direction('column') // Column | Row (Allows to place the Icon on top)
                            ->columns(6),
                                                    
                            Forms\Components\Grid::make(3)
                            ->schema([
                                \LaraZeus\Quantity\Components\Quantity::make('attribute.maximum_capacity')
                                    ->default(3)
                                    ->maxValue(10)
                                    ->minValue(2)                         
                                    ->label('Maximum number of guests'),
                            ]),
                        
                           
                Forms\Components\Fieldset::make('Property Name')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                            Forms\Components\TextInput::make('attribute.display_name')
                                ->label('Display Name'),
                            Forms\Components\TextInput::make('attribute.name')
                                ->label('Name')
                                ->required(),
                            ])
                     ]),
                Forms\Components\Fieldset::make('Property Address')
                     ->schema([
                         Forms\Components\Grid::make(2)                            
                             ->schema([
                                Forms\Components\TextInput::make('address.street_number')
                                    ->label('Street Number'),
                                Forms\Components\TextInput::make('address.street')
                                    ->label('Street'),
                                Forms\Components\TextInput::make('address.city')
                                    ->label('City'),
                                Forms\Components\TextInput::make('address.state')
                                    ->label('State'),
                                Forms\Components\TextInput::make('address.zip_code')
                                    ->label('Zip Code'),
                                Forms\Components\Select::make('address.country_id')
                                    ->label('Country')
                                    ->options($countries)
                                    ->required(),
                             ])
                      ]),

                Forms\Components\Fieldset::make('Optionnal')
                     ->schema([
                         Forms\Components\Grid::make(2)
                             ->schema([
                                Forms\Components\TextInput::make('address.property_number')
                                    ->label('Property Number'),
                                Forms\Components\TextInput::make('address.floor')
                                    ->label('Floor'),
                                Forms\Components\TextInput::make('address.building_number')
                                    ->label('Building Number'),
                                Forms\Components\TextInput::make('address.latitude')
                                    ->label('Latitude')
                                    ->numeric(),
                                Forms\Components\TextInput::make('address.longitude')
                                    ->label('Longitude')
                                    ->numeric(),
                             ])
                      ]),
            ])
            ->statePath('data')
            ->model($this->record);
    }


    public function generalCreate()
    {
        $data = $this->generalForm->getState();

        $property = Property::find($this->record->id);

        $propertyAttribute = PropertyAttribute::find($property->property_attribute_id);

        $propertyAttribute->update($data['attribute']);


        $propertyAddress = $property->address;

        $propertyAddress->update($data['address']);

        Notification::make()
            ->title('General Saved successfully')
            ->success()
            ->duration(5000)
            ->send();
    }


    public function render(): View
    {
        return view('livewire.properties.edit.general');
    }
}
