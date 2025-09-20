<?php

use App\Enums\MentorStatus;
use App\Mail\MentorApprovedMail;
use App\Models\Mentor;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    Mail::fake();
});

test('approval email is queued when mentor is approved', function () {
    // Create an admin user first
    $admin = User::factory()->create();

    $mentor = Mentor::factory()->create([
        'status' => MentorStatus::Pending,
        'email' => 'mentor@example.com',
    ]);

    $mentor->approve($admin->id);

    Mail::assertQueued(MentorApprovedMail::class, function ($mail) use ($mentor) {
        return $mail->hasTo($mentor->email) &&
               $mail->mentor->id === $mentor->id;
    });

    expect($mentor->fresh()->status)->toBe(MentorStatus::Approved);
});

test('mentor approval works even if email is null', function () {
    // Create an admin user first for foreign key constraint
    $admin = User::factory()->create();

    $mentor = Mentor::factory()->create([
        'status' => MentorStatus::Pending,
        'email' => null,
    ]);

    $mentor->approve($admin->id);

    Mail::assertNothingQueued();
    expect($mentor->fresh()->status)->toBe(MentorStatus::Approved);
});

test('approval email contains correct mentor information', function () {
    $mentor = Mentor::factory()->create([
        'status' => MentorStatus::Pending,
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);

    $mail = new MentorApprovedMail($mentor);
    $content = $mail->content();

    expect($content->with)->toHaveKey('mentor');
    expect($content->with)->toHaveKey('expertiseAreas');
    expect($content->with['mentor']->name)->toBe('John Doe');
});

test('approval email has correct subject and from address', function () {
    $mentor = Mentor::factory()->create(['status' => MentorStatus::Pending]);

    $mail = new MentorApprovedMail($mentor);
    $envelope = $mail->envelope();

    expect($envelope->subject)->toBe('Welcome to GeTu Mentorship Program!');
    expect($envelope->from->address)->toBe(config('mail.from.address'));
    expect($envelope->from->name)->toBe(config('mail.from.name'));
});

test('approving mentor through admin interface sends email', function () {
    $admin = User::factory()->create();
    $mentor = Mentor::factory()->create([
        'status' => MentorStatus::Pending,
        'email' => 'mentor@example.com',
    ]);

    $this->actingAs($admin);

    $mentor->approve($admin->id);

    Mail::assertQueued(MentorApprovedMail::class, 1);
    expect($mentor->fresh()->approved_by)->toBe($admin->id);
});

test('multiple mentor approvals queue multiple emails', function () {
    // Create admin user for foreign key constraint
    $admin = User::factory()->create();

    $mentors = Mentor::factory()
        ->count(3)
        ->sequence(
            ['email' => 'mentor1@example.com'],
            ['email' => 'mentor2@example.com'],
            ['email' => 'mentor3@example.com'],
        )
        ->create(['status' => MentorStatus::Pending]);

    foreach ($mentors as $mentor) {
        $mentor->approve($admin->id);
    }

    Mail::assertQueued(MentorApprovedMail::class, 3);
});