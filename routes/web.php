<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SocialNetworkTypes;
use App\Http\Livewire\Contents;
use App\Http\Livewire\Awards;


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

Route::get('/test', function () {
    return view('layouts.test');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('projects', \App\Http\Livewire\Projects::class)->name('projects');

    Route::get('Video', \App\Http\Livewire\videoComponent::class)->name('Video');

    Route::get('socialNetworks', \App\Http\Livewire\SocialNetworks::class)->name('socialNetworks');

    Route::get('SocialNetworkTypes', \App\Http\Livewire\SocialNetworkTypeComponent::class)->name('socialnetworktype');

    Route::get('image', \App\Http\Livewire\Images::class)->name('image');

    Route::get('imagesauthors', \App\Http\Livewire\ImagesAuthors::class)->name('imagesauthors');

    Route::get('allies', \App\Http\Livewire\Allies::class)->name('allies');

    Route::get('award', \App\Http\Livewire\Awards::class)->name('awards');

    Route::get('projectreferences',\App\Http\Livewire\ProjectReferenceComponet::class)->name('projectreferences');

    Route::get('content', \App\Http\Livewire\ContentComponent::class)->name('content');

    Route::get('project_awards', \App\Http\Livewire\ProjectAwards::class)->name('project_awards');

    Route::get('authors', \App\Http\Livewire\Authors::class)->name('authors');

    Route::get('projecttypes', \App\Http\Livewire\ProjectTypes::class)->name('projecttypes');
  
});



