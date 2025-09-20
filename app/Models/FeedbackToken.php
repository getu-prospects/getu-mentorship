<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class FeedbackToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'session_id',
        'type',
        'used',
        'expires_at',
        'used_at',
    ];

    protected function casts(): array
    {
        return [
            'used' => 'boolean',
            'expires_at' => 'datetime',
            'used_at' => 'datetime',
        ];
    }

    public function mentorshipSession(): BelongsTo
    {
        return $this->belongsTo(MentorshipSession::class, 'session_id');
    }

    public static function createForSession(MentorshipSession $session, string $type): self
    {
        return self::create([
            'token' => Str::random(64),
            'session_id' => $session->id,
            'type' => $type,
            'expires_at' => now()->addDays(7),
        ]);
    }

    public function markAsUsed(): void
    {
        $this->update([
            'used' => true,
            'used_at' => now(),
        ]);
    }

    public function isValid(): bool
    {
        return !$this->used && $this->expires_at->isFuture();
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }
}
