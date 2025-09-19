<?php

namespace App\Filament\Resources\MentorshipRequests\Tables;

use App\Enums\MentorshipRequestStatus;
use App\Models\MentorshipRequest;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class MentorshipRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('mentee_name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('mentee_email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email copied'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (MentorshipRequestStatus $state): string => match ($state) {
                        MentorshipRequestStatus::Pending => 'warning',
                        MentorshipRequestStatus::Matched => 'info',
                        MentorshipRequestStatus::Completed => 'success',
                        MentorshipRequestStatus::Cancelled => 'danger',
                    })
                    ->formatStateUsing(fn (MentorshipRequestStatus $state): string => $state->label()),

                TextColumn::make('matchedMentor.name')
                    ->label('Matched Mentor')
                    ->placeholder('Not matched')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Requested')
                    ->dateTime('M j, Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        MentorshipRequestStatus::Pending->value => 'Pending Match',
                        MentorshipRequestStatus::Matched->value => 'Matched',
                        MentorshipRequestStatus::Completed->value => 'Completed',
                        MentorshipRequestStatus::Cancelled->value => 'Cancelled',
                    ])
                    ->multiple(),

                SelectFilter::make('preferred_expertise')
                    ->label('Expertise Needed')
                    ->relationship('expertiseCategories', 'name')
                    ->multiple()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('cancel')
                        ->label('Cancel Selected')
                        ->icon('heroicon-o-x-mark')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->cancel())
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->recordUrl(
                fn (MentorshipRequest $record): string => route('filament.admin.resources.mentorship-requests.view', ['record' => $record])
            );
    }
}