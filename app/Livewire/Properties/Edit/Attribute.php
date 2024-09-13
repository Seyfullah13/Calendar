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

class Attribute extends Component implements HasForms
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
        $this->attributeForm->fill($this->record->toArray());
                
    }

    protected function getForms(): array
    {
        return [
            'attributeForm',
        ];
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
                             // supports all color custom or not
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
                                '1' => 'tabler-bed',
                                '2' => 'tabler-bed',
                                '3' => 'tabler-bed',
                                '4' => 'tabler-bed',
                            ])
                            ->iconPosition(IconPosition::After) // Before | After | (string - before | after)
                            ->alignment(Alignment::Center) // Start | Center | End | (string - start | center | end)
                             // supports all color custom or not
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
                                '1' => 'tabler-bath',
                                '2' => 'tabler-bath',
                                '3' => 'tabler-bath',
                                '4' => 'tabler-bath',
                            ])
                            ->iconPosition(IconPosition::After) // Before | After | (string - before | after)
                            ->alignment(Alignment::Center) // Start | Center | End | (string - start | center | end)
                             // supports all color custom or not
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
            ->model($this->record);
    }


    public function attributeCreate()
    {
        $data = $this->attributeForm->getState();

        $property = Property::find($this->record->id);

        $propertyAttribute = PropertyAttribute::find($property->property_attribute_id);

        $propertyAttribute->update($data['attribute']);

        Notification::make()
            ->title('Attributes Saved successfully')
            ->success()
            ->duration(5000)
            ->persistent()
            ->send();
        
    }


    public function render(): View
    {
        return view('livewire.properties.edit.attribute');
    }
}
