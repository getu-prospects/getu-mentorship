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

class MenteeMatchNotificationMail extends Mailable implements ShouldQueue
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
            subject: 'Great News! You\'ve Been Matched with a Mentor',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $feedbackUrl = null;
        if ($this->feedbackToken) {
            $feedbackUrl = \Illuminate\Support\Facades\URL::signedRoute(
                'feedback.form',
                ['token' => $this->feedbackToken->token],
                $this->feedbackToken->expires_at
            );
        }

        return new Content(
            view: 'emails.mentee-match-notification',
            with: [
                'mentorshipRequest' => $this->mentorshipRequest,
                'mentor' => $this->mentor,
                'hasBookingLink' => ! empty(trim($this->mentor->booking_calendar_link)),
                'expertiseAreas' => $this->mentor->expertiseCategories->pluck('name')->toArray(),
                'feedbackUrl' => $feedbackUrl,
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
