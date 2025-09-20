<?php

use App\Livewire\MentorApplication;
use App\Livewire\MentorshipRequestForm;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('landing');
// })->name('landing');

Route::redirect('/', '/mentorship/request');

Route::get('/mentor/apply', MentorApplication::class)->name('mentor.apply');

Route::get('/mentorship/request', MentorshipRequestForm::class)->name('mentorship.request');

Route::get('/feedback/{token}', [\App\Http\Controllers\FeedbackController::class, 'showFeedbackForm'])
    ->name('feedback.form')
    ->middleware('signed');

Route::post('/feedback/{token}', [\App\Http\Controllers\FeedbackController::class, 'submitFeedback'])
    ->name('feedback.submit')
    ->middleware('signed');

Route::get('/report/{token}', [\App\Http\Controllers\FeedbackController::class, 'showReportForm'])
    ->name('report.form')
    ->middleware('signed');

Route::post('/report/{token}', [\App\Http\Controllers\FeedbackController::class, 'submitReport'])
    ->name('report.submit')
    ->middleware('signed');
