<?php

namespace App\Enums;

enum MentorshipRequestStatus: string
{
    case Pending = 'pending';
    case Matched = 'matched';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending Match',
            self::Matched => 'Matched',
            self::Completed => 'Completed',
            self::Cancelled => 'Cancelled',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Matched => 'info',
            self::Completed => 'success',
            self::Cancelled => 'danger',
        };
    }

    public function isActive(): bool
    {
        return in_array($this, [self::Pending, self::Matched], true);
    }

    public function isFinal(): bool
    {
        return in_array($this, [self::Completed, self::Cancelled], true);
    }
}
