<?php

use App\Livewire\MentorApplication;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/mentor/apply', MentorApplication::class)->name('mentor.apply');
