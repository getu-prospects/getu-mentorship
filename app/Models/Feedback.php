<?php

namespace App\Models;

use App\Enums\FeedbackType;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'session_id',
        'feedback_type',
        'rating',
        'comments',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'feedback_type' => FeedbackType::class,
            'rating' => 'integer',
            'submitted_at' => 'datetime:Y-m-d H:i:s',
        ];
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(MentorshipSession::class, 'session_id');
    }

    #[Scope]
    protected function mentorFeedback(Builder $query): void
    {
        $query->where('feedback_type', FeedbackType::Mentor);
    }

    #[Scope]
    protected function menteeFeedback(Builder $query): void
    {
        $query->where('feedback_type', FeedbackType::Mentee);
    }

    #[Scope]
    protected function highRating(Builder $query): void
    {
        $query->where('rating', '>=', 4);
    }

    #[Scope]
    protected function lowRating(Builder $query): void
    {
        $query->where('rating', '<=', 2);
    }

    #[Scope]
    protected function submitted(Builder $query): void
    {
        $query->whereNotNull('submitted_at');
    }

    public function isMentorFeedback(): bool
    {
        return $this->feedback_type === FeedbackType::Mentor;
    }

    public function isMenteeFeedback(): bool
    {
        return $this->feedback_type === FeedbackType::Mentee;
    }

    public function isSubmitted(): bool
    {
        return $this->submitted_at !== null;
    }

    public function isHighRating(): bool
    {
        return $this->rating >= 4;
    }

    public function isLowRating(): bool
    {
        return $this->rating <= 2;
    }

    public function submit(): void
    {
        $this->update(['submitted_at' => now()]);
    }
}
