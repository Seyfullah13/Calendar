<?php

namespace App\Livewire\Check;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Actions\BulkActionGroup;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CheckIn extends Component implements HasForms, HasTable
{
  use InteractsWithTable;
  use InteractsWithForms;

  public static function table(Table $table): Table
  {
    $now = Carbon::now();
    $thirtyDaysFromNow = Carbon::now()->addDays(30);

    $userProperties = Auth::user()->userRoles->pluck('property.id');
    $bookingQuery = Booking::query()
      ->whereIn('property_id', $userProperties)
      ->wherebetween('check_in', [$now, $thirtyDaysFromNow])
      ->orderBy('check_in', 'asc');

    return $table
      ->query($bookingQuery)
      ->columns([
        TextColumn::make('guest')
          ->label('Guest name')
          ->view('theme::dashboard.filament-custom-guest-col'),
        TextColumn::make('property')
          ->label('Property')
          ->view('theme::dashboard.filament-custom-property-col'),
        TextColumn::make('check_in')
          ->label('Date')
          ->formatStateUsing(fn(Booking $checkIn): string => \Carbon\Carbon::parse($checkIn->check_in)->format('d F Y')),
        TextColumn::make('time')
          ->label('Hour')
          ->getStateUsing(fn(Booking $checkIn): string => \Carbon\Carbon::parse($checkIn->check_in)->format('H:i ')),
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
        BulkActionGroup::make([
          //Tables\Actions\DeleteBulkAction::make(),
        ]),
      ])
      ->paginated([5, 10, 25, 50, 100, 'all'])
      ->defaultPaginationPageOption(5);
  }

  public function render(): View
  {
    return view('livewire.check.check-in');
  }
}
