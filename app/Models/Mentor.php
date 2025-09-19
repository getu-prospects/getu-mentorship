<?php

namespace App\Models;

use App\Enums\MentorStatus;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mentor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'location',
        'profession',
        'booking_calendar_link',
        'additional_contribution',
        'join_online_community',
        'status',
        'approved_at',
        'approved_by',
    ];

    protected function casts(): array
    {
        return [
            'join_online_community' => 'boolean',
            'status' => MentorStatus::class,
            'approved_at' => 'datetime:Y-m-d H:i:s',
        ];
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function mentorshipRequests(): HasMany
    {
        return $this->hasMany(MentorshipRequest::class, 'matched_mentor_id');
    }

    public function mentorshipSessions(): HasMany
    {
        return $this->hasMany(MentorshipSession::class);
    }

    public function expertiseCategories(): BelongsToMany
    {
        return $this->belongsToMany(ExpertiseCategory::class, 'mentor_expertise', 'mentor_id', 'expertise_category_id');
    }

    #[Scope]
    protected function approved(Builder $query): void
    {
        $query->where('status', MentorStatus::Approved);
    }

    #[Scope]
    protected function pending(Builder $query): void
    {
        $query->where('status', MentorStatus::Pending);
    }

    #[Scope]
    protected function suspended(Builder $query): void
    {
        $query->where('status', MentorStatus::Suspended);
    }

    #[Scope]
    protected function rejected(Builder $query): void
    {
        $query->where('status', MentorStatus::Rejected);
    }

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('status', MentorStatus::Approved);
    }

    public function isApproved(): bool
    {
        return $this->status === MentorStatus::Approved;
    }

    public function isPending(): bool
    {
        return $this->status === MentorStatus::Pending;
    }

    public function isSuspended(): bool
    {
        return $this->status === MentorStatus::Suspended;
    }

    public function isRejected(): bool
    {
        return $this->status === MentorStatus::Rejected;
    }

    public function approve(?int $approverId = null): void
    {
        $this->update([
            'status' => MentorStatus::Approved,
            'approved_at' => now(),
            'approved_by' => $approverId,
        ]);

        // Send approval email asynchronously
        if ($this->email) {
            try {
                \Illuminate\Support\Facades\Mail::to($this->email)
                    ->queue(new \App\Mail\MentorApprovedMail($this));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Failed to queue approval email for mentor ' . $this->id . ': ' . $e->getMessage());
            }
        }
    }

    public function suspend(): void
    {
        $this->update(['status' => MentorStatus::Suspended]);
    }

    public function reject(): void
    {
        $this->update(['status' => MentorStatus::Rejected]);
    }
}
