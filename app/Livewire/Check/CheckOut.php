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

class CheckOut extends Component implements HasForms, HasTable
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
      ->wherebetween('check_out', [$now, $thirtyDaysFromNow])
      ->orderBy('check_out', 'asc');

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
          ->formatStateUsing(fn(Booking $checkOut): string => \Carbon\Carbon::parse($checkOut->check_out)->format('d F Y')),
        TextColumn::make('time')
          ->label('Hour')
          ->getStateUsing(fn(Booking $checkOut): string => \Carbon\Carbon::parse($checkOut->check_out)->format('H:i ')),
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

  // private function getBookingsQuery()
  // {
  //   $userProperties = Auth::user()->userRoles->pluck('property.id');

  //   return Booking::query()
  //     ->whereIn('property_id', $userProperties)
  //     ->whereYear('booked_at', '=', date('Y'));
  // }

  public function render(): View
  {
    return view('livewire.check.check-out');
  }
}
