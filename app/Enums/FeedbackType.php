<?php

namespace App\Enums;

enum FeedbackType: string
{
    case Mentor = 'mentor';
    case Mentee = 'mentee';

    public function label(): string
    {
        return match ($this) {
            self::Mentor => 'Mentor Feedback',
            self::Mentee => 'Mentee Feedback',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Mentor => 'Feedback provided by the mentor about the mentee',
            self::Mentee => 'Feedback provided by the mentee about the mentor',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Mentor => 'heroicon-o-academic-cap',
            self::Mentee => 'heroicon-o-user',
        };
    }
}
