<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\BookingController;
use Wave\Facades\Wave;
use App\Livewire\Calendar;
use App\Livewire\CalendarMonth;

use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ContactsController;

use App\Http\Controllers\PropertyController;
use App\Http\Controllers\CustomerController;

// Authentication routes
Auth::routes();

// Voyager Admin routes
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// Wave routes
Wave::routes();


//Menu routes

Route::group(['middleware' => 'auth'], function () {
    // Route add-booking
    Route::get('/booking', [MenuController::class, 'booking'])->name('booking');
    Route::get('/bookings/create', [BookingController::class, 'addBookings'])->name('booking.create');
    Route::get('/bookings/{bookingId}/edit', [BookingController::class, 'edit'])->name('booking.edit');


    Route::get('/calendar', [MenuController::class, 'calendar'])->name('calendar');

    Route::get('/statistics', [MenuController::class, 'statistics'])->name('statistics');

    Route::get('/properties', [MenuController::class, 'properties'])->name('properties');
    Route::get('/properties/{propertyId}/edit', [PropertyController::class, 'edit'])->name('properties.edit');

    Route::get('/property-attributes', [MenuController::class, 'propertyAttributes'])->name('propertiesAttributes');
    Route::get('/property-addresses', [MenuController::class, 'propertyAddresses'])->name('propertiesAddresses');
    Route::get('/property-calendar', [MenuController::class, 'propertyCalendar'])->name('property-calendar');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/customers/import', [CustomerController::class, 'import'])->name('customers.import');

    // Route::get('/properties/{propertyId}/edit', EditProperty::class)->name('properties.edit');


    Route::get('/account', [MenuController::class, 'account'])->name('account');
    Route::get('/contacts', [MenuController::class, 'contacts'])->name('contacts');

    // Inbox routes
    Route::controller(InboxController::class)->group(function () {
        Route::get('/inbox', 'index')->name('inbox');
        Route::get('/inbox/{conversation}', 'show')->name('inbox.show');
    });


    // Contacts routes
    Route::controller(ContactsController::class)->group(function () {
        Route::get('/contacts', 'index')->name('contacts');
        Route::get('/contacts/{contact}', 'show')->name('contacts.show');
        Route::get('/contacts-complete', 'complete')->name('contacts.complete');
        Route::post('/contact/update', 'update')->name('contacts.update');
    });

    // Apps routes
    Route::controller(ApplicationsController::class)->group(function () {
        Route::get('/apps', 'index')->name('applications');
    });
});

#OAuth
// Redirection vers le fournisseur (Google, Apple, Facebook)
Route::get("{provider}/callback", [\App\Http\Controllers\SSOLoginController::class, 'callback'])->name('sso.callback');

// Callback du fournisseur (Google, Apple, Facebook)
Route::get('{provider}/redirect', [\App\Http\Controllers\SSOLoginController::class, 'redirect'])->name('sso.redirect');

//portal import Properties
Route::get('/properties/import', [PropertyController::class, 'import'])->name('properties.import');
Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
// Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');


//Calendar Routes
//calendar Controller pour modifier les adresses mail et numero de telephone
Route::get('/get-events', [Calendar::class, 'getEvents'])->name('get-events');
Route::post('/update-arival', [Calendar::class, 'updateArivalTime']);
Route::post('/update-departur', [Calendar::class, 'updateDeparturTime']);
Route::post('/update-phone', [Calendar::class, 'updatePhone']);
Route::post('/update-email', [Calendar::class, 'updateEmail']);
Route::post('/load-events', [Calendar::class, 'loadEvents']);
Route::post('/update-arrival-date', [Calendar::class, 'updateArrivalDate']);
Route::post('/update-departure-date', [Calendar::class, 'updateDepartureDate']);


#route AI
Route::post('/improve-message', [AIController::class, 'improveMessage']);
