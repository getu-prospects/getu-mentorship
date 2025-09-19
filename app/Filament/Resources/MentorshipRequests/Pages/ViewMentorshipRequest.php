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
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ViewMentorshipRequest extends ViewRecord
{
    protected static string $resource = MentorshipRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('assign')
                ->label('Assign to Mentor')
                ->icon('heroicon-o-user-plus')
                ->color('success')
                ->visible(fn (MentorshipRequest $record): bool => $record->isPending())
                ->modalWidth('7xl')
                ->modalDescription(function (MentorshipRequest $record): string {
                    $expertise = $record->expertiseCategories->pluck('name')->implode(', ');
                    return "Assigning mentor for: {$record->mentee_name}\nRequested expertise: " . ($expertise ?: 'None specified');
                })
                ->form([
                    \Filament\Schemas\Components\Section::make('Request Summary')
                        ->description('Review the mentee\'s request before selecting a mentor')
                        ->schema([
                            Placeholder::make('help_description_display')
                                ->label('What they need help with')
                                ->content(fn (MentorshipRequest $record): string => $record->help_description),

                            Placeholder::make('requested_expertise')
                                ->label('Requested Areas of Expertise')
                                ->content(function (MentorshipRequest $record): string {
                                    $expertise = $record->expertiseCategories->pluck('name')->implode(', ');
                                    return $expertise ?: 'None specified';
                                }),
                        ])
                        ->collapsible()
                        ->collapsed(false),

                    \Filament\Schemas\Components\Section::make('Select a Mentor')
                        ->description('Choose from mentors with matching expertise')
                        ->schema([
                            Select::make('mentor_id')
                                ->label('Available Mentors')
                                ->options(function (MentorshipRequest $record) {
                                    // Get expertise IDs from the many-to-many relationship
                                    $expertiseIds = $record->expertiseCategories()->pluck('expertise_categories.id')->toArray();

                                    $mentors = Mentor::query()
                                        ->approved()
                                        ->with('expertiseCategories')
                                        ->get();

                                    $options = [];
                                    foreach ($mentors as $mentor) {
                                        $mentorExpertise = $mentor->expertiseCategories->pluck('name')->implode(', ');
                                        $hasMatch = false;

                                        if (count($expertiseIds) > 0) {
                                            $hasMatch = $mentor->expertiseCategories()->whereIn('expertise_categories.id', $expertiseIds)->exists();
                                        }

                                        $label = $mentor->name;
                                        if ($mentorExpertise) {
                                            $label .= " | Expertise: {$mentorExpertise}";
                                        }
                                        if ($hasMatch) {
                                            $label = "⭐ {$label} (MATCHING EXPERTISE)";
                                        }

                                        $options[$mentor->id] = $label;
                                    }

                                    // Sort to put matching mentors first
                                    return collect($options)
                                        ->sortBy(function ($label) {
                                            return str_starts_with($label, '⭐') ? 0 : 1;
                                        })
                                        ->toArray();
                                })
                                ->searchable()
                                ->required()
                                ->helperText('Mentors with matching expertise are marked with ⭐ and shown first')
                                ->native(false)
                                ->allowHtml()
                                ->optionsLimit(100),

                            Textarea::make('notes')
                                ->label('Assignment Notes (Optional)')
                                ->placeholder('Any additional notes about this assignment')
                                ->rows(3),
                        ]),
                ])
                ->action(function (array $data, MentorshipRequest $record): void {
                    $mentor = Mentor::find($data['mentor_id']);
                    $record->match($mentor, auth()->id());

                    Notification::make()
                        ->title('Mentor Assigned Successfully')
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
                    ]),

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
                    ]),

                Section::make('Mentorship Details')
                    ->schema([
                        TextEntry::make('help_description')
                            ->label('What they need help with')
                            ->prose(),

                        TextEntry::make('expertiseCategories.name')
                            ->label('Areas of Expertise Needed')
                            ->badge()
                            ->color('primary')
                            ->separator(', ')
                            ->default('None specified'),
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
                            ->placeholder('No session scheduled'),
                    ])
                    ->visible(fn (MentorshipRequest $record): bool => $record->isMatched() || $record->isCompleted()),
            ]);
    }
}