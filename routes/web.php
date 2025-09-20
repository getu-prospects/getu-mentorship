<?php

use App\Livewire\MentorApplication;
use App\Livewire\MentorshipRequestForm;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

// Route::redirect('/', '/mentorship/request');

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

// Email preview routes (for testing only)
if (app()->environment(['local', 'testing'])) {
    Route::get('/email-preview/mentee-match', function () {
        $mentorshipRequest = \App\Models\MentorshipRequest::with('expertiseCategories')->first()
            ?? \App\Models\MentorshipRequest::factory()->create();
        $mentor = \App\Models\Mentor::with('expertiseCategories')->first()
            ?? \App\Models\Mentor::factory()->create();

        return view('emails.mentee-match-notification', [
            'mentorshipRequest' => $mentorshipRequest,
            'mentor' => $mentor,
            'hasBookingLink' => !empty($mentor->booking_calendar_link),
            'expertiseAreas' => $mentor->expertiseCategories->pluck('name')->toArray(),
            'feedbackUrl' => 'https://example.com/feedback/preview-token',
        ]);
    });

    Route::get('/email-preview/mentor-match', function () {
        $mentorshipRequest = \App\Models\MentorshipRequest::with('expertiseCategories')->first()
            ?? \App\Models\MentorshipRequest::factory()->create();
        $mentor = \App\Models\Mentor::with('expertiseCategories')->first()
            ?? \App\Models\Mentor::factory()->create();

        return view('emails.mentor-match-notification', [
            'mentorshipRequest' => $mentorshipRequest,
            'mentor' => $mentor,
            'hasBookingLink' => !empty($mentor->booking_calendar_link),
            'requestedExpertise' => $mentorshipRequest->expertiseCategories->pluck('name')->toArray(),
            'hasAssignmentNotes' => !empty($mentorshipRequest->assignment_notes),
            'reportUrl' => 'https://example.com/report/preview-token',
        ]);
    });

    Route::get('/email-preview/mentor-approved', function () {
        $mentor = \App\Models\Mentor::with('expertiseCategories')->first()
            ?? \App\Models\Mentor::factory()->create();

        return view('emails.mentor-approved', [
            'mentor' => $mentor,
        ]);
    });
}
