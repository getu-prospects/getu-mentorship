<?php

namespace App\Filament\Resources\Mentors\Pages;

use App\Filament\Resources\Mentors\MentorResource;
use App\Enums\MentorStatus;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class ViewMentor extends ViewRecord
{
    protected static string $resource = MentorResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->schema([
                        TextEntry::make('name')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('email')
                            ->icon('heroicon-o-envelope')
                            ->copyable(),
                        TextEntry::make('phone')
                            ->icon('heroicon-o-phone')
                            ->copyable()
                            ->visible(fn ($record) => $record->phone !== null),
                        TextEntry::make('location')
                            ->icon('heroicon-o-map-pin'),
                        TextEntry::make('profession')
                            ->visible(fn ($record) => $record->profession !== null),
                    ])->columns(2),

                Section::make('Status & Approval')
                    ->schema([
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (MentorStatus $state): string => match ($state) {
                                MentorStatus::Pending => 'warning',
                                MentorStatus::Approved => 'success',
                                MentorStatus::Suspended => 'danger',
                                MentorStatus::Rejected => 'gray',
                            }),
                        TextEntry::make('approved_at')
                            ->dateTime()
                            ->visible(fn ($record) => $record->approved_at !== null),
                        TextEntry::make('approvedBy.name')
                            ->label('Approved By')
                            ->visible(fn ($record) => $record->approved_by !== null),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->label('Applied At'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->label('Last Updated'),
                    ])->columns(2),

                Section::make('Expertise & Availability')
                    ->schema([
                        TextEntry::make('expertiseCategories.name')
                            ->label('Areas of Expertise')
                            ->badge()
                            ->color('primary'),
                        TextEntry::make('booking_link')
                            ->label('Booking Calendar')
                            ->url(fn ($state) => $state, shouldOpenInNewTab: true)
                            ->visible(fn ($record) => $record->booking_link !== null),
                    ]),

                Section::make('Community Engagement')
                    ->schema([
                        TextEntry::make('additional_contribution')
                            ->label('Additional Ways to Help')
                            ->visible(fn ($record) => $record->additional_contribution !== null),
                        TextEntry::make('join_online_community')
                            ->label('WhatsApp Community Member')
                            ->badge()
                            ->color(fn ($state) => $state ? 'success' : 'gray')
                            ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),
                    ]),

                Section::make('Mentorship Activity')
                    ->schema([
                        TextEntry::make('mentorshipSessions_count')
                            ->label('Total Sessions')
                            ->counts('mentorshipSessions')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('mentorshipRequests_count')
                            ->label('Total Requests')
                            ->counts('mentorshipRequests')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('mentorshipSessions.scheduled_at')
                            ->label('Last Session')
                            ->dateTime()
                            ->visible(fn ($record) => $record->mentorshipSessions()->exists()),
                    ])->columns(3),
            ]);
    }

    protected function getHeaderActions(): array
    {
        $actions = [
            EditAction::make(),
        ];

        // Add approve action if pending
        if ($this->record->status === MentorStatus::Pending) {
            $actions[] = Action::make('approve')
                ->label('Approve Mentor')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->approve(auth()->id());
                    Notification::make()
                        ->title('Mentor approved successfully')
                        ->success()
                        ->send();
                });

            $actions[] = Action::make('reject')
                ->label('Reject Application')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->reject();
                    Notification::make()
                        ->title('Mentor application rejected')
                        ->danger()
                        ->send();
                });
        }

        // Add suspend action if approved
        if ($this->record->status === MentorStatus::Approved) {
            $actions[] = Action::make('suspend')
                ->label('Suspend Mentor')
                ->icon('heroicon-o-no-symbol')
                ->color('danger')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->suspend();
                    Notification::make()
                        ->title('Mentor suspended')
                        ->warning()
                        ->send();
                });
        }

        return $actions;
    }
}