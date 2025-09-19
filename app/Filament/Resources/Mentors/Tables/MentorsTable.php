<?php

namespace App\Filament\Resources\Mentors\Tables;

use App\Models\Mentor;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class MentorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email copied')
                    ->copyMessageDuration(1500)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('phone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('location')
                    ->label('Location')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('profession')
                    ->label('Profession')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('expertiseCategories.name')
                    ->label('Expertise')
                    ->badge()
                    ->separator(', ')
                    ->wrap(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state): string => match ($state->value ?? $state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'suspended' => 'danger',
                        'rejected' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('mentorship_sessions_count')
                    ->label('Sessions')
                    ->counts('mentorshipSessions')
                    ->badge()
                    ->color('info'),
                TextColumn::make('join_online_community')
                    ->label('Community')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'gray')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Yes' : 'No')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('approved_at')
                    ->label('Approved')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Applied')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending Review',
                        'approved' => 'Approved',
                        'suspended' => 'Suspended',
                        'rejected' => 'Rejected',
                    ]),
                SelectFilter::make('expertise')
                    ->relationship('expertiseCategories', 'name')
                    ->multiple()
                    ->preload(),
            ])
            ->recordUrl(
                fn (Mentor $record): string => route('filament.admin.resources.mentors.view', ['record' => $record]),
            )
            ->recordActions([
                ViewAction::make(),
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Mentor $record): bool => $record->status === 'pending')
                    ->action(function (Mentor $record): void {
                        $record->approve(auth()->id());

                        Notification::make()
                            ->title('Mentor approved')
                            ->success()
                            ->send();
                    }),
                Action::make('suspend')
                    ->label('Suspend')
                    ->icon('heroicon-o-no-symbol')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (Mentor $record): bool => $record->status === 'approved')
                    ->action(function (Mentor $record): void {
                        $record->suspend();

                        Notification::make()
                            ->title('Mentor suspended')
                            ->warning()
                            ->send();
                    }),
                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (Mentor $record): bool => $record->status === 'pending')
                    ->action(function (Mentor $record): void {
                        $record->reject();

                        Notification::make()
                            ->title('Mentor rejected')
                            ->danger()
                            ->send();
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('approve')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion()
                        ->action(function (Collection $records): void {
                            $records->each(function (Mentor $record) {
                                if ($record->status === 'pending') {
                                    $record->approve(auth()->id());
                                }
                            });

                            Notification::make()
                                ->title('Mentors approved')
                                ->success()
                                ->send();
                        }),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
