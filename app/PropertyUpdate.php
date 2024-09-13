<?php

namespace App;

use Filament\Forms;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;

use App\Models\PropertyAttribute;
use App\Models\Address;
use App\Models\Property;

use App\Models\PropertyType;
use App\Models\Timezone;
use App\Models\Currency;

use App\Models\Partenaire;

final class PropertyUpdate
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
                        Forms\Components\Grid::make(3) 
                            ->relationship('address')
                            ->schema([
                                Forms\Components\TextInput::make('property_number')
                                    ->label('Property Number'),                                
                                Forms\Components\TextInput::make('floor')
                                    ->label('Floor'),
                                Forms\Components\TextInput::make('building_number')
                                    ->label('Building Number'),
                                Forms\Components\TextInput::make('number')
                                    ->label('Street Number'),
                                Forms\Components\TextInput::make('street')
                                    ->label('Street'),                                
                                Forms\Components\TextInput::make('city')
                                    ->label('City'),
                                Forms\Components\TextInput::make('state')
                                    ->label('State'),
                                Forms\Components\TextInput::make('zip_code')
                                    ->label('Zip Code'),
                                Forms\Components\Select::make('country')
                                    ->label('Country')
                                    ->options($optionsCountries)
                                    ->required(),
                                Forms\Components\TextInput::make('latitude')
                                    ->label('Latitude')
                                    ->numeric(),
                                Forms\Components\TextInput::make('longitude')
                                    ->label('Longitude')
                                    ->numeric(),
                            ]),
                    ]),
                Wizard\Step::make('Attributes')
                    ->schema([
                        Forms\Components\Grid::make(3) 
                            ->relationship('attribute')
                            ->schema([
                                Forms\Components\TextInput::make('display_name')
                                    ->label('Display Name'),
                                Forms\Components\TextInput::make('name')
                                    ->label('Name')
                                    ->required(),
                                Forms\Components\TextInput::make('square_metre')
                                    ->label('Square Metre')
                                    ->numeric(),
                                Forms\Components\Select::make('time_zone')
                                    ->label('Time Zone')
                                    ->options($timezones),
                                Forms\Components\Select::make('room_type')
                                    ->label('Room Type')
                                    ->options($propertyTypes->toArray()),
                                Forms\Components\Select::make('currency')
                                    ->label('Currency')
                                    ->options($currencies->toArray())
                                    ->native(false)
                                    ->required(),
                                Forms\Components\TextInput::make('maximum_capacity')
                                    ->label('Maximum Capacity')
                                    ->numeric(),
                                Forms\Components\TextInput::make('bedrooms')
                                    ->label('Bedrooms')
                                    ->numeric(),
                                Forms\Components\TextInput::make('beds')
                                    ->label('Beds')
                                    ->numeric(),
                                Forms\Components\TextInput::make('bathroom')
                                    ->label('Bathroom')
                                    ->numeric(),
                                
                                Forms\Components\Textarea::make('description')
                                    ->label('Description')
                                    ->rows(5)  
                                    ->extraInputAttributes(['width' => 200]),
                                Forms\Components\Textarea::make('summary')
                                    ->label('Summary')
                                    ->rows(5)  
                                    ->extraInputAttributes(['width' => 200]),
                            ]),
                    ]),
                    Wizard\Step::make('Photos')
                    ->schema([
                        Forms\Components\Grid::make(1)
                            ->relationship('photo')
                            ->schema([
                                FileUpload::make('url')
                                ->imageEditor(),
                                
                            ]),
                ]),
                Wizard\Step::make('Partenaires')
                    ->schema([
                        Forms\Components\Grid::make(1)
                            ->schema([
                                Forms\Components\MultiSelect::make('partenaire_id')
                                    ->label('PlateForms')
                                    ->relationship('partenaires', 'name')
                                    ->searchable(false)
                            ])
                ]),

                Wizard\Step::make('House Rules')
                    ->schema([                            
                            Forms\Components\Grid::make(3)
                            ->relationship('attribute')
                            ->schema([
                                Forms\Components\Toggle::make('pets')
                                    ->label('Pets Allowed')
                                    ->onColor('success')
                                    ->offColor('danger'),
                                Forms\Components\Toggle::make('smoking')
                                    ->label('Smoking Allowed')
                                    ->onColor('success')
                                    ->offColor('danger'),
                                Forms\Components\Toggle::make('party')
                                    ->label('Party Allowed')
                                    ->onColor('success')
                                    ->offColor('danger'),
                            ])
                ]),

            ])
        ];
    }
}
