<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DocumentController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('documents/search', [DocumentController::class, 'search'])
        ->name('documents.search')
        ->middleware('auth');
Route::get('documents/download/{id}', [DocumentController::class, 'download'])
        ->name('documents.download')
        ->middleware('auth');
        
Route::resource('documents', DocumentController::class)->middleware('auth');

