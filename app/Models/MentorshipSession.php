<?php

namespace App\Models;

use App\Enums\MentorshipSessionStatus;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MentorshipSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'mentor_id',
        'scheduled_at',
        'session_status',
        'session_notes',
    ];

    protected function casts(): array
    {
        return [
            'session_status' => MentorshipSessionStatus::class,
            'scheduled_at' => 'datetime:Y-m-d H:i:s',
        ];
    }

    public function request(): BelongsTo
    {
        return $this->belongsTo(MentorshipRequest::class, 'request_id');
    }

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }

    public function feedback(): HasMany
    {
        return $this->hasMany(Feedback::class, 'session_id');
    }

    public function feedbackTokens(): HasMany
    {
        return $this->hasMany(FeedbackToken::class, 'session_id');
    }

    public function mentorFeedback(): HasMany
    {
        return $this->feedback()->where('feedback_type', 'mentor');
    }

    public function menteeFeedback(): HasMany
    {
        return $this->feedback()->where('feedback_type', 'mentee');
    }

    #[Scope]
    protected function scheduled(Builder $query): void
    {
        $query->where('session_status', MentorshipSessionStatus::Scheduled);
    }

    #[Scope]
    protected function completed(Builder $query): void
    {
        $query->where('session_status', MentorshipSessionStatus::Completed);
    }

    #[Scope]
    protected function cancelled(Builder $query): void
    {
        $query->where('session_status', MentorshipSessionStatus::Cancelled);
    }

    #[Scope]
    protected function noShow(Builder $query): void
    {
        $query->where('session_status', MentorshipSessionStatus::NoShow);
    }

    public function isScheduled(): bool
    {
        return $this->session_status === MentorshipSessionStatus::Scheduled;
    }

    public function isCompleted(): bool
    {
        return $this->session_status === MentorshipSessionStatus::Completed;
    }

    public function isCancelled(): bool
    {
        return $this->session_status === MentorshipSessionStatus::Cancelled;
    }

    public function isNoShow(): bool
    {
        return $this->session_status === MentorshipSessionStatus::NoShow;
    }

    public function complete(?string $notes = null): void
    {
        $this->update([
            'session_status' => MentorshipSessionStatus::Completed,
            'session_notes' => $notes,
        ]);
    }

    public function cancel(?string $notes = null): void
    {
        $this->update([
            'session_status' => MentorshipSessionStatus::Cancelled,
            'session_notes' => $notes,
        ]);
    }

    public function markAsNoShow(?string $notes = null): void
    {
        $this->update([
            'session_status' => MentorshipSessionStatus::NoShow,
            'session_notes' => $notes,
        ]);
    }
}
