<?php

namespace App\Mail;

use App\Models\Mentor;
use App\Models\MentorshipRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MentorMatchNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public MentorshipRequest $mentorshipRequest,
        public Mentor $mentor,
        public ?\App\Models\FeedbackToken $feedbackToken = null
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new \Illuminate\Mail\Mailables\Address(config('mail.from.address'), config('mail.from.name')),
            subject: 'You\'ve Been Matched with a Mentee!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $reportUrl = null;
        if ($this->feedbackToken) {
            $reportUrl = \Illuminate\Support\Facades\URL::signedRoute(
                'report.form',
                ['token' => $this->feedbackToken->token],
                $this->feedbackToken->expires_at
            );
        }

        return new Content(
            view: 'emails.mentor-match-notification',
            with: [
                'mentorshipRequest' => $this->mentorshipRequest,
                'mentor' => $this->mentor,
                'hasBookingLink' => ! empty(trim($this->mentor->booking_calendar_link)),
                'requestedExpertise' => $this->mentorshipRequest->expertiseCategories->pluck('name')->toArray(),
                'hasAssignmentNotes' => ! empty(trim($this->mentorshipRequest->assignment_notes)),
                'reportUrl' => $reportUrl,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
