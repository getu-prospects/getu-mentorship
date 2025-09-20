<?php

use App\Enums\FeedbackType;
use App\Enums\MentorshipRequestStatus;
use App\Enums\MentorshipSessionStatus;
use App\Models\Feedback;
use App\Models\FeedbackToken;
use App\Models\Mentor;
use App\Models\MentorshipRequest;
use App\Models\MentorshipSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;

uses(RefreshDatabase::class);

test('mentorship matching creates session and feedback tokens', function () {
    $mentor = Mentor::factory()->create();
    $request = MentorshipRequest::factory()->create();

    $request->match($mentor);

    expect($request->fresh())
        ->status->toBe(MentorshipRequestStatus::Matched)
        ->matched_mentor_id->toBe($mentor->id);

    $session = $request->mentorshipSession;
    expect($session)
        ->not->toBeNull()
        ->session_status->toBe(MentorshipSessionStatus::Scheduled);

    $tokens = $session->feedbackTokens;
    expect($tokens)->toHaveCount(2);

    $menteeToken = $tokens->where('type', 'mentee_feedback')->first();
    $mentorToken = $tokens->where('type', 'mentor_report')->first();

    expect($menteeToken)
        ->not->toBeNull()
        ->isValid()->toBeTrue();

    expect($mentorToken)
        ->not->toBeNull()
        ->isValid()->toBeTrue();
});

test('feedback form displays correctly for valid token', function () {
    $session = MentorshipSession::factory()->create();
    $token = FeedbackToken::createForSession($session, 'mentee_feedback');

    $signedUrl = URL::signedRoute('feedback.form', ['token' => $token->token]);

    $response = $this->get($signedUrl);

    $response->assertOk()
        ->assertSee('Session Feedback')
        ->assertSee($session->request->mentee_name)
        ->assertSee($session->mentor->name);
});

test('report form displays correctly for valid token', function () {
    $session = MentorshipSession::factory()->create();
    $token = FeedbackToken::createForSession($session, 'mentor_report');

    $signedUrl = URL::signedRoute('report.form', ['token' => $token->token]);

    $response = $this->get($signedUrl);

    $response->assertOk()
        ->assertSee('Session Report')
        ->assertSee($session->request->mentee_name)
        ->assertSee($session->mentor->name);
});

test('can submit feedback successfully', function () {
    $session = MentorshipSession::factory()->create();
    $token = FeedbackToken::createForSession($session, 'mentee_feedback');

    $formUrl = URL::signedRoute('feedback.form', ['token' => $token->token]);
    $submitUrl = URL::signedRoute('feedback.submit', ['token' => $token->token]);

    // First, visit the form to get the CSRF token
    $formResponse = $this->get($formUrl);
    $formResponse->assertOk();

    // Extract CSRF token from the form response
    $csrfToken = $this->app['session']->token();

    $response = $this->post($submitUrl, [
        '_token' => $csrfToken,
        'rating' => 5,
        'comments' => 'This was an excellent mentorship session. Very helpful!'
    ]);

    $response->assertOk()
        ->assertSee('Feedback Submitted Successfully');

    expect(Feedback::count())->toBe(1);

    $feedback = Feedback::first();
    expect($feedback)
        ->session_id->toBe($session->id)
        ->feedback_type->toBe(FeedbackType::Mentee)
        ->rating->toBe(5)
        ->comments->toBe('This was an excellent mentorship session. Very helpful!');

    expect($token->fresh())
        ->used->toBeTrue()
        ->used_at->not->toBeNull();
});

test('can submit report successfully', function () {
    $session = MentorshipSession::factory()->create();
    $token = FeedbackToken::createForSession($session, 'mentor_report');

    $formUrl = URL::signedRoute('report.form', ['token' => $token->token]);
    $submitUrl = URL::signedRoute('report.submit', ['token' => $token->token]);

    // First, visit the form to get the CSRF token
    $formResponse = $this->get($formUrl);
    $formResponse->assertOk();

    // Extract CSRF token from the form response
    $csrfToken = $this->app['session']->token();

    $response = $this->post($submitUrl, [
        '_token' => $csrfToken,
        'rating' => 4,
        'comments' => 'Good session. Covered career planning and networking strategies.'
    ]);

    $response->assertOk()
        ->assertSee('Report Submitted Successfully');

    expect(Feedback::count())->toBe(1);

    $feedback = Feedback::first();
    expect($feedback)
        ->session_id->toBe($session->id)
        ->feedback_type->toBe(FeedbackType::Mentor)
        ->rating->toBe(4)
        ->comments->toBe('Good session. Covered career planning and networking strategies.');

    expect($token->fresh())
        ->used->toBeTrue()
        ->used_at->not->toBeNull();
});

test('cannot access form with expired token', function () {
    $session = MentorshipSession::factory()->create();
    $token = FeedbackToken::create([
        'token' => 'expired-token',
        'session_id' => $session->id,
        'type' => 'mentee_feedback',
        'expires_at' => now()->subDay(),
        'used' => false,
    ]);

    $signedUrl = URL::signedRoute('feedback.form', ['token' => $token->token]);

    $response = $this->get($signedUrl);

    $response->assertStatus(410);
});

test('cannot access form with used token', function () {
    $session = MentorshipSession::factory()->create();
    $token = FeedbackToken::createForSession($session, 'mentee_feedback');
    $token->markAsUsed();

    $signedUrl = URL::signedRoute('feedback.form', ['token' => $token->token]);

    $response = $this->get($signedUrl);

    $response->assertStatus(410);
});

test('cannot access form without signed URL', function () {
    $session = MentorshipSession::factory()->create();
    $token = FeedbackToken::createForSession($session, 'mentee_feedback');

    $response = $this->get("/feedback/{$token->token}");

    $response->assertStatus(403);
});

test('validates required fields when submitting feedback', function () {
    $session = MentorshipSession::factory()->create();
    $token = FeedbackToken::createForSession($session, 'mentee_feedback');

    $formUrl = URL::signedRoute('feedback.form', ['token' => $token->token]);
    $submitUrl = URL::signedRoute('feedback.submit', ['token' => $token->token]);

    // First, visit the form to get the CSRF token
    $formResponse = $this->get($formUrl);
    $formResponse->assertOk();

    // Extract CSRF token from the form response
    $csrfToken = $this->app['session']->token();

    $response = $this->post($submitUrl, [
        '_token' => $csrfToken,
    ]);

    $response->assertSessionHasErrors(['rating', 'comments']);

    expect(Feedback::count())->toBe(0);
    expect($token->fresh()->used)->toBeFalse();
});
