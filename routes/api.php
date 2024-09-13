<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\InboxController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return auth()->user();
});

Route::group(['middleware' => ['auth:api']], function() {
    Route::get('/user/contact', function (Request $request) {
        return auth()->user()->contact;
    });
    
    Route::get('/conversations', [InboxController::class, 'index']);
    Route::get('/conversations/{conversation}', [InboxController::class, 'show']);
    Route::get('/conversations/{conversation}/read', [InboxController::class, 'read']);
    Route::post('/conversations/{conversation}', [InboxController::class, 'store']);
    Route::post('/conversations/{conversation}/add_reaction', [InboxController::class, 'add_reaction']);
    Route::post('/conversations/{conversation}/remove_reaction', [InboxController::class, 'remove_reaction']);
    Route::post('/conversations/{conversation}/upload', [InboxController::class, 'uploadFile']);
    Route::post('/conversations/{conversation}/messages/delete', [InboxController::class, 'deleteMessage']);
    Route::post('/conversations/talk-in-private/{id}', [InboxController::class, 'talkInPrivate']);
});

Wave::api();
