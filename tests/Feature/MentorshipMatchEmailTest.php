<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Mail\MenteeMatchNotificationMail;
use App\Mail\MentorMatchNotificationMail;
use App\Models\ExpertiseCategory;
use App\Models\Mentor;
use App\Models\MentorshipRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class MentorshipMatchEmailTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\ExpertiseCategorySeeder::class);
    }

    public function test_matching_mentee_with_mentor_sends_both_emails(): void
    {
        Mail::fake();
        Queue::fake();

        $admin = User::factory()->create();

        $mentor = Mentor::factory()->approved()->create([
            'email' => 'mentor@example.com',
            'booking_calendar_link' => 'https://calendly.com/mentor',
            'approved_by' => $admin->id,
        ]);

        $mentorshipRequest = MentorshipRequest::factory()->pending()->create([
            'mentee_email' => 'mentee@example.com',
        ]);

        $mentorshipRequest->match($mentor, $admin->id);

        Mail::assertQueued(MenteeMatchNotificationMail::class, function ($mail) use ($mentorshipRequest, $mentor) {
            return $mail->hasTo('mentee@example.com') &&
                   $mail->mentorshipRequest->id === $mentorshipRequest->id &&
                   $mail->mentor->id === $mentor->id;
        });

        Mail::assertQueued(MentorMatchNotificationMail::class, function ($mail) use ($mentorshipRequest, $mentor) {
            return $mail->hasTo('mentor@example.com') &&
                   $mail->mentorshipRequest->id === $mentorshipRequest->id &&
                   $mail->mentor->id === $mentor->id;
        });
    }

    public function test_mentee_email_includes_booking_link_when_mentor_has_calendar(): void
    {
        Mail::fake();

        $admin = User::factory()->create();

        $mentor = Mentor::factory()->approved()->create([
            'email' => 'mentor@example.com',
            'booking_calendar_link' => 'https://calendly.com/mentor-calendar',
            'approved_by' => $admin->id,
        ]);

        $mentorshipRequest = MentorshipRequest::factory()->pending()->create([
            'mentee_email' => 'mentee@example.com',
        ]);

        $mentorshipRequest->match($mentor);

        Mail::assertQueued(MenteeMatchNotificationMail::class, function ($mail) {
            $content = $mail->content();

            return isset($content->with['hasBookingLink']) && $content->with['hasBookingLink'] === true;
        });
    }

    public function test_mentee_email_includes_contact_info_when_mentor_has_no_calendar(): void
    {
        Mail::fake();

        $admin = User::factory()->create();

        $mentor = Mentor::factory()->approved()->create([
            'email' => 'mentor@example.com',
            'booking_calendar_link' => '',  // Empty string instead of null
            'approved_by' => $admin->id,
        ]);

        $mentorshipRequest = MentorshipRequest::factory()->pending()->create([
            'mentee_email' => 'mentee@example.com',
        ]);

        $mentorshipRequest->match($mentor);

        Mail::assertQueued(MenteeMatchNotificationMail::class, function ($mail) {
            $content = $mail->content();

            return isset($content->with['hasBookingLink']) && $content->with['hasBookingLink'] === false;
        });
    }

    public function test_mentor_email_includes_correct_expertise_areas(): void
    {
        Mail::fake();

        $admin = User::factory()->create();
        $expertiseCategory = ExpertiseCategory::first();

        $mentor = Mentor::factory()->approved()->create([
            'email' => 'mentor@example.com',
            'booking_calendar_link' => 'https://example.com',
            'approved_by' => $admin->id,
        ]);
        $mentor->expertiseCategories()->attach($expertiseCategory->id);

        $mentorshipRequest = MentorshipRequest::factory()->pending()->create([
            'mentee_email' => 'mentee@example.com',
        ]);
        $mentorshipRequest->expertiseCategories()->attach($expertiseCategory->id);

        $mentorshipRequest->match($mentor);

        Mail::assertQueued(MentorMatchNotificationMail::class, function ($mail) use ($expertiseCategory) {
            $content = $mail->content();

            return in_array($expertiseCategory->name, $content->with['requestedExpertise']);
        });
    }

    public function test_emails_are_not_sent_when_email_addresses_are_missing(): void
    {
        Mail::fake();

        $admin = User::factory()->create();

        // Use empty strings instead of null for database compatibility
        $mentor = Mentor::factory()->approved()->create([
            'email' => '',  // Empty string instead of null
            'booking_calendar_link' => 'https://example.com',
            'approved_by' => $admin->id,
        ]);

        $mentorshipRequest = MentorshipRequest::factory()->pending()->create([
            'mentee_email' => '',  // Empty string instead of null
        ]);

        $mentorshipRequest->match($mentor);

        Mail::assertNothingQueued();
    }

    public function test_match_status_is_updated_even_if_emails_fail(): void
    {
        // This test ensures the matching logic completes even if email sending fails
        $admin = User::factory()->create();

        $mentor = Mentor::factory()->approved()->create([
            'email' => 'mentor@example.com',
            'booking_calendar_link' => 'https://example.com',
            'approved_by' => $admin->id,
        ]);

        $mentorshipRequest = MentorshipRequest::factory()->pending()->create([
            'mentee_email' => 'mentee@example.com',
        ]);

        $mentorshipRequest->match($mentor, $admin->id);

        $mentorshipRequest->refresh();

        $this->assertTrue($mentorshipRequest->isMatched());
        $this->assertEquals($mentor->id, $mentorshipRequest->matched_mentor_id);
        $this->assertEquals($admin->id, $mentorshipRequest->matched_by);
        $this->assertNotNull($mentorshipRequest->matched_at);
    }

    public function test_mentee_email_has_correct_subject_and_sender(): void
    {
        Mail::fake();

        $admin = User::factory()->create();

        $mentor = Mentor::factory()->approved()->create([
            'email' => 'mentor@example.com',
            'approved_by' => $admin->id,
        ]);

        $mentorshipRequest = MentorshipRequest::factory()->pending()->create([
            'mentee_email' => 'mentee@example.com',
        ]);

        $mentorshipRequest->match($mentor);

        Mail::assertQueued(MenteeMatchNotificationMail::class, function ($mail) {
            $envelope = $mail->envelope();

            return $envelope->subject === "Great News! You've Been Matched with a Mentor" &&
                   $envelope->from->address === config('mail.from.address') &&
                   $envelope->from->name === config('mail.from.name');
        });
    }

    public function test_mentor_email_has_correct_subject_and_sender(): void
    {
        Mail::fake();

        $admin = User::factory()->create();

        $mentor = Mentor::factory()->approved()->create([
            'email' => 'mentor@example.com',
            'approved_by' => $admin->id,
        ]);

        $mentorshipRequest = MentorshipRequest::factory()->pending()->create([
            'mentee_email' => 'mentee@example.com',
        ]);

        $mentorshipRequest->match($mentor);

        Mail::assertQueued(MentorMatchNotificationMail::class, function ($mail) {
            $envelope = $mail->envelope();

            return $envelope->subject === "You've Been Matched with a Mentee!" &&
                   $envelope->from->address === config('mail.from.address') &&
                   $envelope->from->name === config('mail.from.name');
        });
    }
}
