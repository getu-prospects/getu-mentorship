<?php

namespace App\Filament\Resources\Mentors\Schemas;

use App\Models\ExpertiseCategory;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
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
                        TextInput::make('location')
                            ->label('Location')
                            ->maxLength(255)
                            ->placeholder('Berlin, Hamburg, München...'),
                        TextInput::make('profession')
                            ->label('Profession')
                            ->maxLength(255)
                            ->placeholder('Software Engineer, Teacher, Doctor...'),
                    ]),

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

                Section::make('Community Engagement')
                    ->schema([
                        Textarea::make('additional_contribution')
                            ->label('Additional Contributions')
                            ->rows(3)
                            ->maxLength(1000)
                            ->helperText('Any special skills or ways they can support the community')
                            ->columnSpanFull(),
                        Checkbox::make('join_online_community')
                            ->label('Join Online Community')
                            ->helperText('Wants to join the online community'),
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
                    ->visible(fn ($context) => $context === 'edit'),
            ]);
    }
}
