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

class EditPhoto extends Component implements HasForms
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

        $this->record = Property::with(['attribute', 'photos'])->findOrFail($propertyId);
        

        $this->fillForms();

    }

    protected function fillForms(): void
    {
        $photoUrls = $this->record->photos->pluck('url')->toArray();

        $this->photoForm->fill([
            'photos' => $photoUrls,
            'description' => $this->record->attribute->description,
            'summary' => $this->record->attribute->summary,
        ]);               
    }

    protected function getForms(): array
    {
        return [
            'photoForm',
        ];
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
                        FileUpload::make('photos')
                            ->label('Property Images')
                            ->directory('property_images')
                            ->multiple()
                            ->enableReordering(),  
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



    public function photoCreate()
    {
        $data = $this->photoForm->getState();

        $property = Property::find($this->record->id);

        $photoUrls = $data['photos'] ?? [];
        
        // Récupérer les IDs des photos à partir des URLs
        $photoIds = [];

        foreach ($photoUrls as $url) {
            // Chercher la photo par son URL
            $photo = Photo::where('url', $url)->first();

            if (!$photo) {
                // Si la photo n'existe pas, créez-la
                $photo = Photo::create([
                    'url' => $url,
                    'order' => null, // ou toute autre valeur par défaut si nécessaire
                    'description' => null,
                    'tags' => null,
                ]);
            }

            // Ajouter l'ID de la photo à la liste des IDs
            $photoIds[] = $photo->id;
        }

        // Synchroniser les photos avec la propriété en utilisant les IDs
        $this->record->photos()->sync($photoIds);


        $propertyAttribute = PropertyAttribute::find($property->property_attribute_id);

        $propertyAttribute->update([
            'description' => $data['description'],
            'summary' => $data['summary'],
        ]);


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
        return view('livewire.properties.edit.edit-photo');
    }
}
