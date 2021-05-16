<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SocialNetworkTypes;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('projects', \App\Http\Livewire\Projects::class)->name('projects');
<<<<<<< HEAD
Route::get('socialNetworks', \App\Http\Livewire\SocialNetworks::class)->name('socialNetworks');
=======

Route::get('SocialNetworkTypes', \App\Http\Livewire\SocialNetworkTypes::class)->name('SocialNetworkType');
>>>>>>> 80199371e109f5a78a1e8bfe6d43dc5640fc3097
