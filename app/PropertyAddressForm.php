<?php

namespace App;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;

final class PropertyAddressForm
{

    public static function schema(): array
    {
        return [
            TextInput::make('property_number')
                ->label('Property Number')
                ->required(),

            TextInput::make('floor')
                ->label('Floor')
                ->required(),

            TextInput::make('building_number')
                ->label('Building Number')
                ->required(),

            TextInput::make('street')
                ->label('Street')
                ->required(),

            TextInput::make('suite')
                ->label('Suite')
                ->required(),

            TextInput::make('city')
                ->label('City')
                ->required(),

            TextInput::make('state')
                ->label('State')
                ->required(),

            TextInput::make('zip_code')
                ->label('Zip Code')
                ->required(),

            TextInput::make('country')
                ->label('Country')
                ->required(),

            TextInput::make('latitude')
                ->label('Latitude')
                ->required(),

            TextInput::make('longitude')
                ->label('Longitude')
                ->required(),
        ];
    }
}
