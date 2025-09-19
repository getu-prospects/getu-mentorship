<?php

namespace App\Filament\Resources\Mentors;

use App\Filament\Resources\Mentors\Pages\CreateMentor;
use App\Filament\Resources\Mentors\Pages\EditMentor;
use App\Filament\Resources\Mentors\Pages\ListMentors;
use App\Filament\Resources\Mentors\Pages\ViewMentor;
use App\Filament\Resources\Mentors\Schemas\MentorForm;
use App\Filament\Resources\Mentors\Tables\MentorsTable;
use App\Models\Mentor;
use BackedEnum;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Table;

class MentorResource extends Resource
{
    protected static ?string $model = Mentor::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Mentors';

    protected static ?string $modelLabel = 'Mentor';

    protected static ?string $pluralModelLabel = 'Mentors';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return MentorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MentorsTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Full Name')
                            ->weight(FontWeight::Bold)
                            ->size('lg'),
                        TextEntry::make('email')
                            ->label('Email Address')
                            ->icon('heroicon-o-envelope')
                            ->copyable()
                            ->copyMessage('Email copied'),
                        TextEntry::make('phone')
                            ->label('Phone Number')
                            ->icon('heroicon-o-phone')
                            ->placeholder('Not provided')
                            ->copyable()
                            ->copyMessage('Phone copied'),
                        TextEntry::make('location')
                            ->label('Location')
                            ->icon('heroicon-o-map-pin')
                            ->placeholder('Not specified'),
                        TextEntry::make('profession')
                            ->label('Profession')
                            ->icon('heroicon-o-briefcase')
                            ->placeholder('Not specified'),
                    ])
                    ->columns(2),

                Section::make('Status & Approval')
                    ->schema([
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn ($state): string => match ($state->value ?? $state) {
                                'pending' => 'warning',
                                'approved' => 'success',
                                'suspended' => 'danger',
                                'rejected' => 'gray',
                                default => 'gray',
                            }),
                        TextEntry::make('approved_at')
                            ->label('Approved Date')
                            ->date()
                            ->placeholder('Not approved yet')
                            ->visible(fn ($record) => $record->approved_at),
                        TextEntry::make('approvedBy.name')
                            ->label('Approved By')
                            ->placeholder('N/A')
                            ->visible(fn ($record) => $record->approved_by),
                        TextEntry::make('created_at')
                            ->label('Application Date')
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->dateTime(),
                    ])
                    ->columns(2),

                Section::make('Expertise & Availability')
                    ->schema([
                        TextEntry::make('expertiseCategories.name')
                            ->label('Areas of Expertise')
                            ->badge()
                            ->separator(', ')
                            ->placeholder('No expertise areas assigned'),
                        TextEntry::make('booking_calendar_link')
                            ->label('Calendar Booking Link')
                            ->url(fn ($state) => $state)
                            ->openUrlInNewTab()
                            ->icon('heroicon-o-calendar')
                            ->placeholder('No booking link provided'),
                    ]),

                Section::make('Community Engagement')
                    ->schema([
                        TextEntry::make('additional_contribution')
                            ->label('Additional Ways to Contribute')
                            ->placeholder('No additional contributions specified')
                            ->columnSpanFull(),
                        TextEntry::make('join_online_community')
                            ->label('Wants to Join Online Community')
                            ->badge()
                            ->color(fn (bool $state): string => $state ? 'success' : 'gray')
                            ->formatStateUsing(fn (bool $state): string => $state ? 'Yes' : 'No'),
                    ]),

                Section::make('Mentorship Activity')
                    ->schema([
                        TextEntry::make('mentorshipSessions')
                            ->label('Total Sessions')
                            ->getStateUsing(fn ($record) => $record->mentorshipSessions()->count())
                            ->badge()
                            ->color('info'),
                        TextEntry::make('mentorshipRequests')
                            ->label('Total Requests')
                            ->getStateUsing(fn ($record) => $record->mentorshipRequests()->count())
                            ->badge()
                            ->color('primary'),
                        TextEntry::make('mentorshipSessions')
                            ->label('Last Session')
                            ->getStateUsing(fn ($record) => $record->mentorshipSessions()->latest()->first()?->session_date)
                            ->date()
                            ->placeholder('No sessions yet'),
                    ])
                    ->columns(3),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMentors::route('/'),
            'create' => CreateMentor::route('/create'),
            'view' => ViewMentor::route('/{record}'),
            'edit' => EditMentor::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}
