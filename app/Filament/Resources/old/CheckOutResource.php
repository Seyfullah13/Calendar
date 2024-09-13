<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CheckOutResource\Pages;
use App\Filament\Resources\CheckOutResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CheckOutResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationLabel = 'Check-Out';

    protected static ?string $navigationIcon = 'heroicon-o-arrow-right-start-on-rectangle';

    protected static ?string $navigationGroup = 'Calendar';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('guest.name')
                    ->label('Guest name'),
                Tables\Columns\TextColumn::make('property.attribute.name')
                    ->label('Property'),
                Tables\Columns\TextColumn::make('check_out')
                    ->label('Date')
                    ->formatStateUsing(fn (Booking $checkOut): string => \Carbon\Carbon::parse($checkOut->check_out)->format('d/m/Y')),
                Tables\Columns\TextColumn::make('time')
                    ->label('Time')
                    ->getStateUsing(fn (Booking $checkOut): string => \Carbon\Carbon::parse($checkOut->check_out)->format('H:i')),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\ViewAction::make(),
                //Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCheckOuts::route('/'),
            'create' => Pages\CreateCheckOut::route('/create'),
            'edit' => Pages\EditCheckOut::route('/{record}/edit'),
        ];
    }
}
