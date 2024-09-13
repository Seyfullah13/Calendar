<?php

namespace App;

use Filament\Forms;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;

use App\Models\PropertyAttribute;
use App\Models\Address;
use App\Models\Property;
use App\Models\Partenaire;

use App\Models\PropertyType;
use App\Models\Timezone;
use App\Models\Currency;


final class PropertyForm
{
    /**
     * Returns the property form schema
     *
     * @return array $schema
     */


    public static function schema(): array
    {

        $propertyTypes = PropertyType::all()->pluck('name', 'name');

        $partenaires = Partenaire::all()->pluck('name')->toArray();

        
        $timezones = Timezone::all()->pluck('name', 'name')->toArray();

        $currencies = Currency::all()->pluck('code', 'code');



        $jsonFilePath = app_path('countries.json');

        // Lire le contenu du fichier JSON
        $jsonData = file_get_contents($jsonFilePath);

        // Convertir les données JSON en tableau associatif
        $countries = json_decode($jsonData, true);

        if (!$countries) {
            Log::error("Failed to decode JSON data from $jsonFilePath");
            return response()->json(['error' => 'Failed to decode JSON data from countries.json']);
        }

        // Créer les options pour le champ de sélection avec les noms des pays comme clés et valeurs
        $optionsCountries = collect($countries)->pluck('name', 'name')->toArray();




        return [

            Wizard::make([
                                         
                Wizard\Step::make('Address')
                    ->schema([
                        
                        Forms\Components\Grid::make(3) // Creating a grid with 3 columns
                            ->schema([
                                Forms\Components\TextInput::make('address.property_number')
                                    ->label('Property Number'),
                                Forms\Components\TextInput::make('address.floor')
                                    ->label('Floor'),
                                Forms\Components\TextInput::make('address.building_number')
                                    ->label('Building Number'),
                                Forms\Components\TextInput::make('address.number')
                                    ->label('Street Number'),
                                Forms\Components\TextInput::make('address.street')
                                    ->label('Street'),
                                
                                Forms\Components\TextInput::make('address.city')
                                    ->label('City'),
                                Forms\Components\TextInput::make('address.state')
                                    ->label('State'),
                                Forms\Components\TextInput::make('address.zip_code')
                                    ->label('Zip Code'),
                                Forms\Components\Select::make('address.country')
                                    ->label('Country')
                                    ->options($optionsCountries)
                                    ->required(),
                                Forms\Components\TextInput::make('address.latitude')
                                    ->label('Latitude')
                                    ->numeric(),
                                Forms\Components\TextInput::make('address.longitude')
                                    ->label('Longitude')
                                    ->numeric(),
                            ]),
                    ]),
                Wizard\Step::make('Attributes')
                    ->schema([
                        Forms\Components\Grid::make(3) // Creating another grid with 3 columns
                            ->schema([
                                Forms\Components\TextInput::make('attribute.display_name')
                                    ->label('Display Name'),
                                Forms\Components\TextInput::make('attribute.name')
                                    ->label('Name')
                                    ->required(),
                                Forms\Components\TextInput::make('attribute.square_metre')
                                    ->label('Square Metre')
                                    ->numeric(),
                                Forms\Components\Select::make('attribute.time_zone')
                                    ->label('Time Zone')
                                    ->options($timezones),
                                Forms\Components\Select::make('attribute.room_type')
                                    ->label('Room Type')
                                    ->options($propertyTypes->toArray()),
                                Forms\Components\Select::make('attribute.currency')
                                    ->label('Currency')
                                    ->options($currencies->toArray())
                                    ->native(false)
                                    ->default('EUR')
                                    ->required(),
                                    Forms\Components\TextInput::make('attribute.maximum_capacity')
                                    ->label('Maximum Capacity')
                                    ->numeric(),
                                Forms\Components\TextInput::make('attribute.bedrooms')
                                    ->label('Bedrooms')
                                    ->numeric(),
                                Forms\Components\TextInput::make('attribute.beds')
                                    ->label('Beds')
                                    ->numeric(),
                                Forms\Components\TextInput::make('attribute.bathroom')
                                    ->label('Bathroom')
                                    ->numeric(),                               
                                Forms\Components\Textarea::make('attribute.description')
                                    ->label('Description')
                                    ->rows(5)  
                                    ->extraInputAttributes(['width' => 200]),
                                Forms\Components\Textarea::make('attribute.summary')
                                    ->label('Summary')
                                    ->rows(5)  
                                    ->extraInputAttributes(['width' => 200]),
                            ]),
                    ]),

                    Wizard\Step::make('Photos')
                        ->schema([
                            Forms\Components\Grid::make(1)
                                ->schema([
                                    FileUpload::make('photo.url')
                                    ->label('Property Images')
                                    ->directory('property_images')
                                    ->multiple()
                                    ->optimize('jpg')
                                    ->resize(50),
                                    
                                ]),
                                
                                
                    ]),
                Wizard\Step::make('Partenaires')
                    ->schema([                            
                            Forms\Components\Grid::make(1)
                            ->schema([
                                Forms\Components\MultiSelect::make('partenaire.id')
                                    ->label('PlateForms')
                                    ->options($partenaires)
                            ])
                ]),
                Wizard\Step::make('House Rules')
                    ->schema([                            
                            Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Toggle::make('attribute.pets')
                                    ->label('Pets Allowed')
                                    ->onColor('success')
                                    ->offColor('danger'),
                                Forms\Components\Toggle::make('attribute.smoking')
                                    ->label('Smoking Allowed')
                                    ->onColor('success')
                                    ->offColor('danger'),
                                Forms\Components\Toggle::make('attribute.party')
                                    ->label('Party Allowed')
                                    ->onColor('success')
                                    ->offColor('danger'),
                            ])
                ]),
            ]),
    
        ];
    }
}
