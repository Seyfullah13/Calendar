<?php

namespace App\Livewire\Properties;

use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use JaOcero\RadioDeck\Forms\Components\RadioDeck;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use RalphJSmit\Filament\MediaLibrary\Forms\Components\MediaPicker;

use Outerweb\FilamentImageLibrary\Filament\Forms\Components\ImageLibraryPicker;
use Filament\Notifications\Notification;

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

class CreateProperty extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $recordId;


    public function mount(): void
    {
        $this->fillForms();
    }

    protected function fillForms(): void
    {
        $this->generalForm->fill();
        $this->attributeForm->fill();
        $this->ruleForm->fill();
        $this->platformForm->fill();
        $this->photoForm->fill();

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
                            ->direction('column') 
                            ->extraAttributes(['class' => 'radio-deck']) // Ajoute des classes CSS personnalisées
                            ->columns(6),
                            
                Forms\Components\Grid::make(3)
                            ->schema([
                                \LaraZeus\Quantity\Components\Quantity::make('attribute.maximum_capacity')
                                    ->default(3)
                                    ->maxValue(10)
                                    ->minValue(1)
                                    ->label('Maximum number of guests')
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
            ->statePath('data');
    }

    public function attributeForm(Form $form): Form
    {   
        $timezones = Timezone::all()->pluck('name', 'name')->toArray();

        $currencies = Currency::all()->pluck('code', 'id');

        $defaultCurrencyId = Currency::where('code', 'EUR')->pluck('id')->first();
        
        return $form
            ->schema([
                Forms\Components\Grid::make(12)
                    ->schema([
                        RadioDeck::make('bedrooms')
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
                            ->extraAttributes(['class' => 'radio-deck']) // Ajoute des classes CSS personnalisées
                            ->columns(4)
                            ->columnSpan(8),
                        
                        Forms\Components\TextInput::make('bedrooms')
                            ->hiddenLabel()
                            ->numeric()
                            ->columnSpan(2)
                            ->extraAttributes(['class' => 'custom-input-style']) // Ajoute des classes CSS personnalisées
                            ->placeholder('More'), // Défi
                    ]),

                    Forms\Components\Grid::make(12)
                    ->schema([
                        RadioDeck::make('beds')
                            ->options([
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                            ])
                            ->icons([
                                '1' => 'tabler-bed',
                                '2' => 'tabler-bed',
                                '3' => 'tabler-bed',
                                '4' => 'tabler-bed',
                            ])
                            ->iconPosition(IconPosition::After) // Before | After | (string - before | after)
                            ->alignment(Alignment::Center) // Start | Center | End | (string - start | center | end)
                            ->extraAttributes(['class' => 'radio-deck']) // Ajoute des classes CSS personnalisées
                            ->columns(4)
                            ->columnSpan(8),
                        
                        Forms\Components\TextInput::make('beds')
                            ->hiddenLabel()
                            ->numeric()
                            ->columnSpan(2)
                            ->extraAttributes(['class' => 'custom-input-style']) // Ajoute des classes CSS personnalisées
                            ->placeholder('More'), // Défi
                    ]),
                    Forms\Components\Grid::make(12)
                    ->schema([
                        RadioDeck::make('bathrooms')
                            ->options([
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                            ])
                            ->icons([
                                '1' => 'tabler-bath',
                                '2' => 'tabler-bath',
                                '3' => 'tabler-bath',
                                '4' => 'tabler-bath',
                            ])
                            ->iconPosition(IconPosition::After) // Before | After | (string - before | after)
                            ->alignment(Alignment::Center) // Start | Center | End | (string - start | center | end)
                            ->extraAttributes(['class' => 'radio-deck']) // Ajoute des classes CSS personnalisées
                            ->columns(4)
                            ->columnSpan(8),
                        
                        Forms\Components\TextInput::make('bathrooms')
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
                        Forms\Components\Textarea::make('description')
                            ->rows(5)
                            ->cols(10)
                            ->hiddenLabel()
                    ]),
                Forms\Components\Card::make('House manual')
                    ->description('Provide essential information about your property,
                         local tips to help guests have a comfortable stay.')
                    ->schema([ 
                        Forms\Components\Textarea::make('summary')
                            ->rows(5)
                            ->cols(10)
                            ->hiddenLabel()
                    ]),
                Forms\Components\Fieldset::make('What is the currency of your property')
                    ->schema([
                        Forms\Components\Grid::make(1)
                            ->schema([ 
                                Forms\Components\Select::make('currency_id')
                                    ->label('Currency')
                                    ->options($currencies->toArray())
                                    ->default($defaultCurrencyId) 
                                    ->required(),
                            ])
                    ]), 
                    
                    Forms\Components\Fieldset::make('Optionnal')
                     ->schema([
                         Forms\Components\Grid::make(2)
                             ->schema([
                                Forms\Components\Select::make('time_zone')
                                    ->label('Time Zone')
                                    ->options($timezones),

                                Forms\Components\TextInput::make('square_metre')
                                    ->label('Square Metre')
                                    ->numeric(),
                             ]),
                         Forms\Components\Textarea::make('summary')
                             ->label('Other details to note')
                             ->columnSpan(8)
                             ->rows(5)
                             ->cols(10),
                      ]),
                
            ])
            ->statePath('data');
    }

    public function ruleForm(Form $form): Form
    {
        return $form
            ->schema([
                ViewField::make('pets')
                    ->view('filament.forms.components.custom-toggle-fields-a', [
                        'label' => 'Pets Allowed',
                        'statePath' => 'data.pets'
                    ])
                    ->default(false),
                ViewField::make('smoking')
                    ->view('filament.forms.components.custom-toggle-fields-a', [
                        'label' => 'Smoking Allowed',
                        'statePath' => 'data.smoking'
                    ])
                    ->default(false),
                ViewField::make('party')
                    ->view('filament.forms.components.custom-toggle-fields-a', [
                        'label' => 'Party Allowed',
                        'statePath' => 'data.party'
                    ])
                    ->default(false),
            ])
            ->statePath('data');
    }


    public function platformForm(Form $form): Form
    {

        $partenaires = Partenaire::all()->pluck('name', 'id')->toArray();

        return $form
            ->schema([
                CheckboxList::make('partenaires')
                    ->options($partenaires)
                    ->hiddenLabel()
                
            ])
            ->statePath('data');
    }

    public function photoForm(Form $form): Form
    {

        return $form
            ->schema([
                // MediaPicker::make('photos')
                //     ->label('Choose images')
                //     ->multiple(),
                Forms\Components\Grid::make(1)
                    ->schema([
                        FileUpload::make('photos')
                            ->label('Property Images')
                            ->directory('property_images')
                            ->multiple()
                            ->enableReordering()
                            ->optimize('jpg')
                            ->resize(50),  
                        ]),

                Forms\Components\Card::make('Add Description')
                    ->description('Tell us what makes your property unique.')
                    ->schema([ 
                        Forms\Components\Textarea::make('description')
                            ->rows(5)
                            ->cols(10)
                            ->hiddenLabel()
                    ]),
                Forms\Components\Card::make('Add Summary')
                    ->schema([ 
                        Forms\Components\Textarea::make('summary')
                            ->rows(5)
                            ->cols(10)
                            ->hiddenLabel()
                    ]),
                
                
            ])
            ->statePath('data');
    }

    


    public function generalCreate()
    {
        $data = $this->generalForm->getState();

         // Créer l'adresse de propriété
         $propertyAddress = new Address($data['address']);

         // Créer les attributs de propriété
         $propertyAttribute = PropertyAttribute::create($data['attribute']);
 
         // Créer la propriété principale
         $record = Property::create([
             'property_attribute_id' => $propertyAttribute->id,
         ]);

         // Associer la propriété principale à son addresse
         $record->address()->save($propertyAddress);
         $record->refresh();

        $user = Auth::user(); // Récupérer l'utilisateur authentifié

        // Récupérer le rôle "Owner"
        $ownerRole = MyRole::where('name', 'Owner')->first();

        // Créer une nouvelle entrée dans my_user_roles
        MyUserRole::create([
            'user_id' => $user->id,
            'property_id' => $record->id, // ID de la propriété récemment créée
            'my_role_id' => $ownerRole->id,
        ]);

         // Stocker l'ID du record créé
         $this->recordId = $record->id;


        $this->generalForm->model($record)->saveRelationships();
            
        return redirect("/properties/create#");

    }

    public function attributeCreate()
    {
        $data = $this->attributeForm->getState();

        $property = Property::find($this->recordId);

        $propertyAttribute = PropertyAttribute::find($property->property_attribute_id);

        $propertyAttribute->update($data);

        $this->attributeForm->model($propertyAttribute)->saveRelationships();

        session()->flash('message', 'Saved successfully');

        return redirect("/properties/create#");
    }

    public function ruleCreate()
    {
        $data = $this->ruleForm->getState();

        $property = Property::find($this->recordId);

        $propertyAttribute = PropertyAttribute::find($property->property_attribute_id);

        $propertyAttribute->update($data);

        $this->ruleForm->model($propertyAttribute)->saveRelationships();


        return redirect("/properties/create#");

    }

    public function platformCreate(): void
    {
        $data = $this->platformForm->getState();


        $property = Property::find($this->recordId);

         // Récupérer les IDs des partenaires depuis les données du formulaire (supposons qu'ils sont dans $data['partenaires'])
        $partenaireIds = $data['partenaires'];

        // Insérer chaque partenaire_id avec l'ID de la propriété dans la table property_partenaire
        foreach ($partenaireIds as $partenaireId) {


            PropertyPartenaire::create([
                'property_id' => $property->id,
                'partenaire_id' => $partenaireId,
            ]);
        }

        Notification::make()
            ->title('Property Saved successfully')
            ->success()
            ->duration(5000)
            ->send();
    }

    public function photoCreate()
    {
        $data = $this->photoForm->getState();

        $property = Property::find($this->recordId);

        // Insérer chaque photo à partir de l'index 1

        if (isset($data['photos'])) {
            $imageUrls = $data['photos'];
            foreach ($imageUrls as $index => $url) {
                $photo = Photo::create([
                    'url' => $url,
                    'order' => $index + 1,
                    'description' => "property photos",
                    'tags' => "files test",
                ]);

                // Insérer l'entrée correspondante dans property_photos
                $property->photos()->attach($photo->id);
            }
        }

        return redirect("/properties/create#");

    }

    public function render(): View
    {
        return view('livewire.properties.create-property');
    }
}