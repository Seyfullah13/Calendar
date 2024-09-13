<?php

namespace App\Livewire\Properties;
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

class EditProperty extends Component implements HasForms
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

    public function getProperty(): string
    {
        return $this->record->attribute->name; // Retourne la valeur de la propriété
    }

    protected function fillForms(): void
    {
        $this->generalForm->fill($this->record->toArray());
        $this->attributeForm->fill($this->record->attribute->toArray());
        $this->ruleForm->fill($this->record->attribute->toArray());
        
        $this->photoForm->fill($this->record->toArray());

        $this->partenaires = $this->record->partenaires->pluck('id')->toArray();
        
    }

    protected function getForms(): array
    {
        return [
            'generalForm',
            'attributeForm',
            'ruleForm',
            'platformForm',
            'photoForm',

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
                            ->color('info') // supports all color custom or not
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

    public function attributeForm(Form $form): Form
    {   
        $timezones = Timezone::all()->pluck('name', 'name')->toArray();

        $currencies = Currency::all()->pluck('code', 'id');

        return $form
            ->schema([
                Forms\Components\Grid::make(12)
                    ->schema([
                        RadioDeck::make('attribute.bedrooms')
                            ->options([
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                            ])
                            ->icons([
                                '1' => 'tabler-door',
                                '2' => 'tabler-door',
                                '3' => 'tabler-door',
                                '4' => 'tabler-door',
                            ])
                            ->iconPosition(IconPosition::After) // Before | After | (string - before | after)
                            ->alignment(Alignment::Center) // Start | Center | End | (string - start | center | end)
                            ->color('primary') // supports all color custom or not
                            ->columns(4)
                            ->columnSpan(8),
                        
                        Forms\Components\TextInput::make('attribute.bedrooms')
                            ->hiddenLabel()
                            ->numeric()
                            ->columnSpan(2)
                            ->extraAttributes(['class' => 'custom-input-style']) // Ajoute des classes CSS personnalisées
                            ->placeholder('More'), // Défi
                    ]),

                    Forms\Components\Grid::make(12)
                    ->schema([
                        RadioDeck::make('attribute.beds')
                            ->options([
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                            ])
                            ->icons([
                                '1' => 'ionicon-bed-outline',
                                '2' => 'ionicon-bed-outline',
                                '3' => 'ionicon-bed-outline',
                                '4' => 'ionicon-bed-outline',
                            ])
                            ->iconPosition(IconPosition::After) // Before | After | (string - before | after)
                            ->alignment(Alignment::Center) // Start | Center | End | (string - start | center | end)
                            ->color('primary') // supports all color custom or not
                            ->columns(4)
                            ->columnSpan(8),
                        
                        Forms\Components\TextInput::make('attribute.beds')
                            ->hiddenLabel()
                            ->numeric()
                            ->columnSpan(2)
                            ->extraAttributes(['class' => 'custom-input-style']) // Ajoute des classes CSS personnalisées
                            ->placeholder('More'), // Défi
                    ]),
                    Forms\Components\Grid::make(12)
                    ->schema([
                        RadioDeck::make('attribute.bathrooms')
                            ->options([
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                            ])
                            ->icons([
                                '1' => 'forkawesome-bath',
                                '2' => 'forkawesome-bath',
                                '3' => 'forkawesome-bath',
                                '4' => 'forkawesome-bath',
                            ])
                            ->iconPosition(IconPosition::After) // Before | After | (string - before | after)
                            ->alignment(Alignment::Center) // Start | Center | End | (string - start | center | end)
                            ->color('primary') // supports all color custom or not
                            ->columns(4)
                            ->columnSpan(8),
                        
                        Forms\Components\TextInput::make('attribute.bathrooms')
                            ->hiddenLabel()
                            ->numeric()
                            ->columnSpan(2)
                            ->extraAttributes(['class' => 'custom-input-style']) // Ajoute des classes CSS personnalisées
                            ->placeholder('More'), // Défi
                    ]),

                    Forms\Components\Card::make('Space overview')
                    ->description('Briefly describe your property, highlighting key features and amenities.
                                This helps attract the right guests and sets accurate expectations.')
                    ->schema([ 
                        Forms\Components\Textarea::make('attribute.description')
                            ->rows(5)
                            ->cols(10)
                            ->hiddenLabel()
                    ]),
                Forms\Components\Card::make('House manual')
                    ->description('Provide essential information about your property,
                         local tips to help guests have a comfortable stay.')
                    ->schema([ 
                        Forms\Components\Textarea::make('attribute.summary')
                            ->rows(5)
                            ->cols(10)
                            ->hiddenLabel()
                    ]),
                Forms\Components\Fieldset::make('What is the currency of your property')
                    ->schema([
                        Forms\Components\Grid::make(1)
                            ->schema([ 
                                Forms\Components\Select::make('attribute.currency_id')
                                    ->label('Currency')
                                    ->options($currencies->toArray())
                                    ->required(),
                            ])
                    ]), 
                    
                    Forms\Components\Fieldset::make('Optionnal')
                     ->schema([
                         Forms\Components\Grid::make(2)
                             ->schema([
                                Forms\Components\Select::make('attribute.time_zone')
                                    ->label('Time Zone')
                                    ->options($timezones),

                                Forms\Components\TextInput::make('attribute.square_metre')
                                    ->label('Square Metre')
                                    ->numeric(),
                             ]),
                         Forms\Components\Textarea::make('attribute.summary')
                             ->label('Other details to note')
                             ->columnSpan(8)
                             ->rows(5)
                             ->cols(10),
                      ]),
                
            ])
            ->statePath('data')
            ->model($this->record->attribute);
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

    public function photoForm(Form $form): Form
    {

        return $form
            ->schema([
                // MediaPicker::make('images')
                //     ->label('Choose images')
                //     ->multiple(),
                Forms\Components\Grid::make(1)
                    ->schema([
                        FileUpload::make('photos.url')
                            ->label('Property Images')
                            ->directory('property_images')
                            ->multiple()
                            ->enableReordering(),  
                        ]),

                Forms\Components\Card::make('Add Description')
                    ->description('Tell us what makes your property unique.')
                    ->schema([ 
                        Forms\Components\Textarea::make('attribute.description')
                            ->rows(5)
                            ->cols(10)
                            ->hiddenLabel()
                    ]),
                Forms\Components\Card::make('Add Summary')
                    ->schema([ 
                        Forms\Components\Textarea::make('attribute.summary')
                            ->rows(5)
                            ->cols(10)
                            ->hiddenLabel()
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
            ->persistent()
            ->send();

        // return redirect()->to("/properties/{$this->propertyId}/edit#");

    }

    public function attributeCreate()
    {
        $data = $this->attributeForm->getState();

        $property = Property::find($this->record->id);

        $propertyAttribute = PropertyAttribute::find($property->property_attribute_id);

        $propertyAttribute->update($data['attribute']);

        // session()->flash('message', 'Attribute successfully updated.');


        Notification::make()
            ->title('Attributes Saved successfully')
            ->success()
            ->duration(5000)
            ->persistent()
            ->send();

        //return redirect("/properties/{$this->propertyId}/edit#");

        
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

        //return redirect("/properties/{$this->propertyId}/edit#");

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


    public function photoCreate()
    {
        $data = $this->photoForm->getState();

        $property = Property::find($this->record->id);

        $propertyAttribute = PropertyAttribute::find($property->property_attribute_id);

        $propertyAttribute->update($data['attribute']);


        Notification::make()
            ->title('Photos Saved successfully')
            ->success()
            ->duration(5000)
            ->persistent()
            ->send();

        //return redirect("/properties/{$this->propertyId}/edit#");

    }

    public function render(): View
    {
        return view('livewire.properties.edit-property', [
            'property' => $this->record,
        ]);
    }
}
