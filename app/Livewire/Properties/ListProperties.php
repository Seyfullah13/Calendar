<?php

namespace App\Livewire\Properties;

use App\Models\Property;
use App\Models\PropertyAttribute;
use App\Models\Address;
use App\Models\MyUserRole;
use App\Models\MyRole;
use App\Models\Ical;
use App\Models\Partenaire;
use App\Models\Photo;
use Filament\Forms\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Filters\SelectFilter;
use Filament\Support\Enums\ActionSize;


use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Filament\Tables\Columns\ImageColumn;
use App\PropertyForm;
use App\PropertyUpdate;
use Illuminate\Support\HtmlString;

use Illuminate\Support\Facades\Auth;


class ListProperties extends Component implements HasForms, HasTable
{
  use InteractsWithForms;
  use InteractsWithTable;

    public Property $property;

    public function mount(Property $property)
    {
        $this->property = $property;
    }

  public function table(Table $table): Table
  {
    $user = Auth::user();

        return $table
            ->query(Property::whereHas('userRoles', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->where('is_enabled', true)
            ->with(static::getRelations()))
            ->columns([
                Tables\Columns\ImageColumn::make('first_photo_url')
                    ->label('IMAGE')->width(70)
                    ->height(40)
                    ->circular(),
                
                Tables\Columns\TextColumn::make('attribute.name')
                    ->label('PROPERTY NAME')
                    ->weight('bold')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address.city')
                    ->label('CITY')
                    ->weight('bold')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address.country.name')
                    ->label('COUNTRY')
                    ->weight('bold')
                    ->searchable(),

        Tables\Columns\TextColumn::make('partenaires')
          ->label('PLATFORMS')
          ->html()
          ->formatStateUsing(function (Property $record) {
            $icons = $record->partenaires->pluck('icon')->toArray();
            $html = '';
            foreach ($icons as $icon) {
              $html .= '<img src="' . $icon . '" alt="Icon" style="max-width: 20px; max-height: 20px; margin-right: 1px; display: inline-block; border-radius: 50%;">';
            }
            return new HtmlString($html);
          })->color('gray'),

        Tables\Columns\TextInputColumn::make('ical_input')
          ->label('ICAL INPUT')
          ->toggleable(isToggledHiddenByDefault: true)
          ->placeholder('Enter Ical url')
          ->beforeStateUpdated(function ($record, $state) {
            $calendarName = "ImportedCalendar";
            $icalUrl = $state ?? null;

            if ($calendarName && $icalUrl) {
              // Extraire le nom du partenaire de l'URL
              $parsedUrl = parse_url($icalUrl);
              $host = $parsedUrl['host'] ?? '';
              $hostParts = explode('.', $host);

              if (count($hostParts) > 1) {
                $partenaireName = strtolower($hostParts[1]);
              } else {
                session()->flash('error', 'Invalid URL');
                return false; // Annuler la mise à jour de l'état
              }

              // Trouver le partenaire dans la table partenaires
              $partenaire = Partenaire::whereRaw('LOWER(name) = ?', [$partenaireName])->first();

              if (!$partenaire) {
                session()->flash('error', 'Partner not found');
                return false; // Annuler la mise à jour de l'état
              }

              $partenaireId = $partenaire->id;

              Ical::updateOrCreate(
                [
                  'property_id' => $record->id,
                  'partenaire_id' => $partenaireId,
                  'calendar_name' => $calendarName,
                ],
                [
                  'ical_url' => $icalUrl,
                ]
              );

                            session()->flash('success', 'Ical saved successfully');
                            exit();
                            return false;
                        } else {
                            session()->flash('error', 'Please fill out both fields');
                            exit();
                            return false; // Annuler la mise à jour de l'état
                        }
                        exit();
                        return false;
                    })
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->model(Property::class)
                    ->url(route('properties.create')) 
                    ->icon('heroicon-s-plus')        
                    ->label('Property'),             
                
            ])
            ->actions([
                Tables\Actions\EditAction::make('Edit')
                ->label('Edit')
                ->icon(false)
                ->color(false)
                ->button()
                ->url(fn (Property $record): string => route('properties.edit', ['propertyId' => $record->id])),
                // ->form(PropertyUpdate::schema()),
                 Tables\Actions\Action::make('disable')
                    ->label(false)
                    ->requiresConfirmation()
                    ->modalHeading('Confirmation')
                    ->modalDescription('Are you sure you want to disable this property?')
                    ->button()
                    ->action(function (Property $record) {
                        $record->is_enabled = false;
                        $record->save();
                        
                        return 'Property disabled successfully';
                    })

                    ->icon('heroicon-c-trash'),
            ])
            ->bulkActions([

            ])
            ->filters([
                SelectFilter::make('country')->relationship('address.country', 'name'),
                SelectFilter::make('partenaires')->relationship('partenaires', 'name')
            ]);
    }

    public static function getRelations(): array
    {
        return [
            'attribute',
            'address',
            'photos',
            'partenaires',
        ];
    }



  public function createProperty(array $data)
  {
    // Créer la première photo
    $first_url = isset($data['photo']['url'][0]) ? $data['photo']['url'][0] : null;
    $first_photo = Photo::create([
      'url' => $first_url,
      'order' => 1,
      'description' => "property photo",
      'tags' => "files test",
    ]);

    // Créer l'adresse de propriété
    $propertyAddress = new Address($data['address']);

    // Créer les attributs de propriété
    $propertyAttribute = PropertyAttribute::create($data['attribute']);

    // Créer la propriété principale
    $property = Property::create([
      'property_attribute_id' => $propertyAttribute->id,
    ]);
    
    // Associer la propriété principale à sa première photo
    $property->photos()->attach($first_photo->id);

    // Associer la propriété principale à son addresse
    $property->address()->save($propertyAddress);
    $property->refresh();

    // Créer l'entrée correspondante dans property_photos pour la première photo
    $property->photos()->attach($first_photo->id);
    
    // Insérer chaque photo à partir de l'index 1
    if (isset($data['photo']['url'])) {
      $imageUrls = array_slice($data['photo']['url'], 1);
      foreach ($imageUrls as $index => $url) {
        $photo = Photo::create([
          'url' => $url,
          'order' => $index + 2,
          'description' => "property photo",
          'tags' => "files test",
        ]);

        // Insérer l'entrée correspondante dans property_photos
        $property->photos()->attach($photo->id);
      }
    }

    $user = Auth::user(); // Récupérer l'utilisateur authentifié

    // Récupérer le rôle "Owner"
    $ownerRole = MyRole::where('name', 'Owner')->first();

    // Créer une nouvelle entrée dans my_user_roles
    MyUserRole::create([
      'user_id' => $user->id,
      'property_id' => $property->id, // ID de la propriété récemment créée
      'my_role_id' => $ownerRole->id,
    ]);
  }





  public function render(): View
  {
    return view('livewire.properties.list-properties');
  }
}