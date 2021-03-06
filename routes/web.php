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

    Route::get('projects', \App\Http\Livewire\ProjectComponent::class)->name('projects');

    Route::get('Video', \App\Http\Livewire\videoComponent::class)->name('Video');

    Route::get('socialNetworks', \App\Http\Livewire\SocialNetworkComponent::class)->name('socialNetwork');

    Route::get('SocialNetworkTypes', \App\Http\Livewire\SocialNetworkTypeComponent::class)->name('socialnetworktype');

    Route::get('image', \App\Http\Livewire\ImagesComponent::class)->name('image');


    Route::get('imagesauthors', \App\Http\Livewire\ImagesAuthorComponent::class)->name('imagesauthors');

    Route::get('allies', \App\Http\Livewire\AllieComponent::class)->name('allies');

    Route::get('award', \App\Http\Livewire\AwardComponent::class)->name('awards');

    Route::get('projectreferences',\App\Http\Livewire\ProjectReferenceComponent::class)->name('projectreferences');

    Route::get('content', \App\Http\Livewire\ContentComponent::class)->name('content');

    Route::get('project_awards', \App\Http\Livewire\ProjectAwardComponent::class)->name('project_awards');

    Route::get('authors', \App\Http\Livewire\AuthorsComponent::class)->name('authors');

    Route::get('projecttypes', \App\Http\Livewire\ProjectTypeComponent::class)->name('projecttypes');

});



