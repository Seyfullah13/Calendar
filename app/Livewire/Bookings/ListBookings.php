<?php

namespace App\Livewire\Bookings;

use App\Models\Booking;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

use Filament\Tables\Filters\SelectFilter;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class ListBookings extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public static function getRelations(): array
    {
        return [
            'property.attribute',
            'status',
            'property'
        ];
    }

    public function table(Table $table): Table
    {
        $user = Auth::user();

        return $table
            ->query(Booking::query()
                ->whereHas('property', function ($query) use ($user) {
                    $query->whereHas('userRoles', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    });
                })
                ->with(static::getRelations()))

            ->columns([
                Tables\Columns\ImageColumn::make('property.first_photo_url')
                    ->label('IMAGE'),
                Tables\Columns\TextColumn::make('property.attribute.name')
                    ->label('Property')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('guest.first_name')
                    ->formatStateUsing(fn ($record) => $record->guest->first_name . ' ' . $record->guest->last_name)
                    ->sortable(),
                Tables\Columns\TextColumn::make('check_in')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('check_out')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_of_nights')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_of_guests')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_of_adults')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('number_of_children')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('number_of_animals')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('external_status')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_fee')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_taxes')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_payout')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('booked_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('partenaire_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status.name')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        switch ($state) {
                            case 'En attente':
                                return '<span style="color: orange;">' . $state . '</span>';
                            case 'Confirmé':
                                return '<span style="color: green;">' . $state . '</span>';
                            case 'Annulée':
                                return '<span style="color: red;">' . $state . '</span>';
                            case 'En cours de traitement':
                                return '<span style="color: blue;">' . $state . '</span>';
                            default:
                                return $state;
                        }
                    })
                    ->html()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->headerActions([
                CreateAction::make()
                    ->label('Booking')
                    ->icon('heroicon-s-plus')        
                    ->url(route('booking.create'))

            ])
            ->filters([
                SelectFilter::make('status')->relationship('status', 'name'),
                // DateRangeFilter::make('check_in')
                //     ->columnSpanFull(),
            ])
            ->actions([
                EditAction::make()
                    ->model(Booking::class)
                    ->label('Edit')
                    ->color('#004F5C')
                    ->extraAttributes([
                        'style' => 'border: 1px solid #004F5C;
                    color: #004F5C;
                    border-radius: 8px;
                    padding: 6px;
                    transition: background-color 0.3s, color 0.3s;',
                        'onmouseover' => "this.style.backgroundColor='#00FF00'; this.style.color='#FFFFFF';", // Fond vert, texte blanc au survol
                        'onmouseout' => "this.style.backgroundColor='transparent'; this.style.color='#00FF00';", // Retour au style initial après le survol
                    ])
                    ->icon('')
                    ->url(fn(Booking $record): string =>
                    route('booking.edit', ['bookingId' => $record->id]))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.bookings.list-bookings');
    }
}
