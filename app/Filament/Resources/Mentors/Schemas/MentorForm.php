<?php

namespace App\Filament\Resources\Mentors\Schemas;

use App\Models\ExpertiseCategory;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MentorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Expertise & Availability')
                    ->schema([
                        Select::make('expertise_areas')
                            ->label('Areas of Expertise')
                            ->multiple()
                            ->options(
                                ExpertiseCategory::query()
                                    ->where('is_active', true)
                                    ->orderBy('sort_order')
                                    ->pluck('name', 'id')
                            )
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('booking_calendar_link')
                            ->label('Calendar Booking Link (Calendly, etc.)')
                            ->url()
                            ->required()
                            ->helperText('e.g., https://calendly.com/your-name')
                            ->maxLength(500),
                    ]),

                Section::make('About')
                    ->schema([
                        Textarea::make('bio')
                            ->label('Biography')
                            ->required()
                            ->rows(4)
                            ->maxLength(2000)
                            ->helperText('Tell us about your background and experience')
                            ->columnSpanFull(),
                    ]),

                Section::make('Status')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending Review',
                                'approved' => 'Approved',
                                'suspended' => 'Suspended',
                            ])
                            ->required()
                            ->default('pending')
                            ->disabled(fn ($context) => $context === 'create'),
                        DateTimePicker::make('approved_at')
                            ->label('Approved Date')
                            ->disabled()
                            ->visible(fn ($get) => $get('status') === 'approved'),
                        Placeholder::make('approved_by_name')
                            ->label('Approved By')
                            ->content(fn ($record) => $record?->approvedBy?->name ?? 'N/A')
                            ->visible(fn ($get, $record) => $get('status') === 'approved' && $record),
                    ])
                    ->columns(2)
                    ->visible(fn ($context) => $context === 'edit'),
            ]);
    }
}
