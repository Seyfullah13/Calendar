<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;
    use HasFactory;
    
    protected $table = 'addresses';
    protected $fillable = ['property_number','floor','building_number',
    'street', 'street_number', 'city','state','zip_code','country_id',
    'latitude', 'longitude'
    ];

    public function country(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function addressable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Convert the address to a formatted string.
     * 
     * Example of use   : $property->address->toString('{street_number} {Street}, {zip_code} {City}, {COUNTRY}')
     * Results          : 46 Rue Saint-James, 33000 Bordeaux, FRANCE
     *
     * @param string $format
     * @return string
     */
    public function toString(string $format)
    {
        $country_name = $this->country->name;

        // Define the placeholders and corresponding attributes
        $placeholders = [
            '{floor}'           => $this->floor,                // lowercase
            '{Floor}'           => ucfirst($this->floor),       // Capitalized
            '{FLOOR}'           => strtoupper($this->floor),    // UPPERCASE
            
            '{building_number}' => $this->building_number,
            '{Building_number}' => ucfirst($this->building_number),
            '{BUILDING_NUMBER}' => strtoupper($this->building_number),
            
            '{street}'          => $this->street,
            '{Street}'          => ucfirst($this->street),
            '{STREET}'          => strtoupper($this->street),
            
            '{street_number}'   => $this->street_number,
            '{Street_number}'   => ucfirst($this->street_number),
            '{STREET_NUMBER}'   => strtoupper($this->street_number),
            
            '{city}'            => $this->city,
            '{City}'            => ucfirst($this->city),
            '{CITY}'            => strtoupper($this->city),
            
            '{state}'           => $this->state,
            '{State}'           => ucfirst($this->state),
            '{STATE}'           => strtoupper($this->state),
            
            '{zip_code}'        => $this->zip_code,
            '{Zip_code}'        => ucfirst($this->zip_code),
            '{ZIP_CODE}'        => strtoupper($this->zip_code),
            
            '{country}'         => $country_name,
            '{Country}'         => ucfirst($country_name),
            '{COUNTRY}'         => strtoupper($country_name),
            
            '{latitude}'        => $this->latitude,
            '{Latitude}'        => ucfirst($this->latitude),
            '{LATITUDE}'        => strtoupper($this->latitude),
            
            '{longitude}'       => $this->longitude,
            '{Longitude}'       => ucfirst($this->longitude),
            '{LONGITUDE}'       => strtoupper($this->longitude),
        ];

        // Replace the placeholders in the format string with actual data
        $formatted_address = str_replace(array_keys($placeholders), array_values($placeholders), $format);

        // Return the formatted address
        return $formatted_address;
    }
}
