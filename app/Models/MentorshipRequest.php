<?php

namespace App\Models;

use App\Enums\MentorshipRequestStatus;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MentorshipRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentee_name',
        'mentee_email',
        'mentee_phone',
        'help_description',
        'preferred_expertise',
        'status',
        'matched_mentor_id',
        'matched_at',
        'matched_by',
    ];

    protected function casts(): array
    {
        return [
            'preferred_expertise' => AsCollection::class,
            'status' => MentorshipRequestStatus::class,
            'matched_at' => 'datetime:Y-m-d H:i:s',
        ];
    }

    public function matchedMentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class, 'matched_mentor_id');
    }

    public function matchedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'matched_by');
    }

    public function mentorshipSession(): HasOne
    {
        return $this->hasOne(MentorshipSession::class, 'request_id');
    }

    #[Scope]
    protected function pending(Builder $query): void
    {
        $query->where('status', MentorshipRequestStatus::Pending);
    }

    #[Scope]
    protected function matched(Builder $query): void
    {
        $query->where('status', MentorshipRequestStatus::Matched);
    }

    #[Scope]
    protected function completed(Builder $query): void
    {
        $query->where('status', MentorshipRequestStatus::Completed);
    }

    #[Scope]
    protected function cancelled(Builder $query): void
    {
        $query->where('status', MentorshipRequestStatus::Cancelled);
    }

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->whereIn('status', [MentorshipRequestStatus::Pending, MentorshipRequestStatus::Matched]);
    }

    public function isMatched(): bool
    {
        return $this->status === MentorshipRequestStatus::Matched;
    }

    public function isPending(): bool
    {
        return $this->status === MentorshipRequestStatus::Pending;
    }

    public function isCompleted(): bool
    {
        return $this->status === MentorshipRequestStatus::Completed;
    }

    public function isCancelled(): bool
    {
        return $this->status === MentorshipRequestStatus::Cancelled;
    }

    public function match(Mentor $mentor, ?int $matchedByUserId = null): void
    {
        $this->update([
            'status' => MentorshipRequestStatus::Matched,
            'matched_mentor_id' => $mentor->id,
            'matched_at' => now(),
            'matched_by' => $matchedByUserId,
        ]);
    }

    public function complete(): void
    {
        $this->update(['status' => MentorshipRequestStatus::Completed]);
    }

    public function cancel(): void
    {
        $this->update(['status' => MentorshipRequestStatus::Cancelled]);
    }
}
