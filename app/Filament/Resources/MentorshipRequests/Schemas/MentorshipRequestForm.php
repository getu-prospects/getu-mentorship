<?php

namespace App\Filament\Resources\MentorshipRequests\Schemas;

use App\Enums\MentorshipRequestStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MentorshipRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('mentee_name')
                    ->required(),
                TextInput::make('mentee_email')
                    ->email()
                    ->required(),
                TextInput::make('mentee_phone')
                    ->tel(),
                Textarea::make('help_description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('preferred_expertise')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(MentorshipRequestStatus::class)
                    ->default('pending')
                    ->required(),
                Select::make('matched_mentor_id')
                    ->relationship('matchedMentor', 'name'),
                DateTimePicker::make('matched_at'),
                TextInput::make('matched_by')
                    ->numeric(),
            ]);
    }
}
