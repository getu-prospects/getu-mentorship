<?php

namespace App\Filament\Resources\MentorshipRequests\Tables;

use App\Enums\MentorshipRequestStatus;
use App\Models\ExpertiseCategory;
use App\Models\Mentor;
use App\Models\MentorshipRequest;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
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
                    }),
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