<?php

use App\Livewire\MentorApplication;
use App\Livewire\MentorshipRequestForm;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/mentor/apply', MentorApplication::class)->name('mentor.apply');

Route::get('/mentorship/request', MentorshipRequestForm::class)->name('mentorship.request');
