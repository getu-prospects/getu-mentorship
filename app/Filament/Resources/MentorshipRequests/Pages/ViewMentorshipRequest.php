<?php

namespace App\Filament\Resources\MentorshipRequests\Pages;

use App\Enums\MentorshipRequestStatus;
use App\Filament\Resources\MentorshipRequests\MentorshipRequestResource;
use App\Models\ExpertiseCategory;
use App\Models\Mentor;
use App\Models\MentorshipRequest;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Split;
use Filament\Schemas\Components\TextEntry;
use Filament\Schemas\Schema;

class ViewMentorshipRequest extends ViewRecord
{
    protected static string $resource = MentorshipRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('match')
                ->label('Match Mentor')
                ->icon('heroicon-o-link')
                ->color('success')
                ->visible(fn (MentorshipRequest $record): bool => $record->isPending())
                ->form([
                    Select::make('mentor_id')
                        ->label('Select Mentor')
                        ->options(function (MentorshipRequest $record) {
                            $expertiseIds = $record->preferred_expertise->toArray();

                            return Mentor::query()
                                ->approved()
                                ->when(count($expertiseIds) > 0, function ($query) use ($expertiseIds) {
                                    $query->whereHas('expertiseCategories', function ($q) use ($expertiseIds) {
                                        $q->whereIn('expertise_categories.id', $expertiseIds);
                                    });
                                })
                                ->pluck('name', 'id');
                        })
                        ->searchable()
                        ->required()
                        ->helperText('Showing mentors with matching expertise'),

                    Textarea::make('notes')
                        ->label('Matching Notes')
                        ->placeholder('Any additional notes about this match')
                        ->rows(3),
                ])
                ->action(function (array $data, MentorshipRequest $record): void {
                    $mentor = Mentor::find($data['mentor_id']);
                    $record->match($mentor, auth()->id());

                    Notification::make()
                        ->title('Mentor Matched Successfully')
                        ->success()
                        ->send();

                    $this->redirect($this->getResource()::getUrl('view', ['record' => $record]));
                }),

            Action::make('complete')
                ->label('Mark Complete')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn (MentorshipRequest $record): bool => $record->isMatched())
                ->requiresConfirmation()
                ->action(function (MentorshipRequest $record): void {
                    $record->complete();

                    Notification::make()
                        ->title('Request Marked as Complete')
                        ->success()
                        ->send();
                }),

            Action::make('cancel')
                ->label('Cancel Request')
                ->icon('heroicon-o-x-mark')
                ->color('danger')
                ->visible(fn (MentorshipRequest $record): bool => $record->isActive())
                ->requiresConfirmation()
                ->action(function (MentorshipRequest $record): void {
                    $record->cancel();

                    Notification::make()
                        ->title('Request Cancelled')
                        ->warning()
                        ->send();
                }),
        ];
    }

    public function infolist(Schema $infolist): Schema
    {
        return $infolist
            ->schema([
                Split::make([
                    Section::make('Request Information')
                        ->schema([
                            TextEntry::make('mentee_name')
                                ->label('Name'),
                            TextEntry::make('mentee_email')
                                ->label('Email')
                                ->copyable(),
                            TextEntry::make('mentee_phone')
                                ->label('Phone')
                                ->default('Not provided'),
                            TextEntry::make('created_at')
                                ->label('Requested')
                                ->dateTime('F j, Y g:i A'),
                        ])
                        ->columns(2),

                    Section::make('Status & Matching')
                        ->schema([
                            TextEntry::make('status')
                                ->badge()
                                ->color(fn (MentorshipRequestStatus $state): string => match ($state) {
                                    MentorshipRequestStatus::Pending => 'warning',
                                    MentorshipRequestStatus::Matched => 'info',
                                    MentorshipRequestStatus::Completed => 'success',
                                    MentorshipRequestStatus::Cancelled => 'danger',
                                })
                                ->formatStateUsing(fn (MentorshipRequestStatus $state): string => $state->label()),

                            TextEntry::make('matchedMentor.name')
                                ->label('Matched Mentor')
                                ->visible(fn (?string $state): bool => filled($state))
                                ->url(fn (MentorshipRequest $record): ?string =>
                                    $record->matched_mentor_id
                                        ? route('filament.admin.resources.mentors.view', ['record' => $record->matched_mentor_id])
                                        : null
                                ),

                            TextEntry::make('matched_at')
                                ->label('Matched At')
                                ->dateTime('F j, Y g:i A')
                                ->visible(fn (?string $state): bool => filled($state)),

                            TextEntry::make('matchedByUser.name')
                                ->label('Matched By')
                                ->visible(fn (?string $state): bool => filled($state)),
                        ])
                        ->columns(2),
                ])
                    ->from('md'),

                Section::make('Mentorship Details')
                    ->schema([
                        TextEntry::make('help_description')
                            ->label('What they need help with')
                            ->prose()
                            ->columnSpanFull(),

                        TextEntry::make('preferred_expertise')
                            ->label('Areas of Expertise Needed')
                            ->formatStateUsing(function ($state): string {
                                if (empty($state)) {
                                    return 'None specified';
                                }

                                $categories = ExpertiseCategory::whereIn('id', $state->toArray())
                                    ->pluck('name')
                                    ->toArray();

                                return implode(', ', $categories);
                            })
                            ->badge()
                            ->color('primary')
                            ->columnSpanFull(),
                    ]),

                Section::make('Session Information')
                    ->schema([
                        TextEntry::make('mentorshipSession.session_date')
                            ->label('Session Date')
                            ->dateTime('F j, Y g:i A')
                            ->placeholder('No session scheduled'),

                        TextEntry::make('mentorshipSession.session_type')
                            ->label('Session Type')
                            ->placeholder('No session scheduled'),

                        TextEntry::make('mentorshipSession.session_status')
                            ->label('Session Status')
                            ->badge()
                            ->placeholder('No session scheduled'),

                        TextEntry::make('mentorshipSession.notes')
                            ->label('Session Notes')
                            ->placeholder('No session scheduled')
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->visible(fn (MentorshipRequest $record): bool => $record->isMatched() || $record->isCompleted()),
            ]);
    }
}