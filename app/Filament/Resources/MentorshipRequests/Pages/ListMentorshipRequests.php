<?php

namespace App\Filament\Resources\MentorshipRequests\Pages;

use App\Enums\MentorshipRequestStatus;
use App\Filament\Resources\MentorshipRequests\MentorshipRequestResource;
use App\Models\MentorshipRequest;
use Filament\Actions\CreateAction;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListMentorshipRequests extends ListRecords
{
    protected static string $resource = MentorshipRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Requests')
                ->badge(MentorshipRequest::count()),

            'pending' => Tab::make('Pending Match')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', MentorshipRequestStatus::Pending))
                ->badge(MentorshipRequest::pending()->count())
                ->badgeColor('warning'),

            'matched' => Tab::make('Matched')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', MentorshipRequestStatus::Matched))
                ->badge(MentorshipRequest::matched()->count())
                ->badgeColor('info'),

            'completed' => Tab::make('Completed')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', MentorshipRequestStatus::Completed))
                ->badge(MentorshipRequest::completed()->count())
                ->badgeColor('success'),

            'cancelled' => Tab::make('Cancelled')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', MentorshipRequestStatus::Cancelled))
                ->badge(MentorshipRequest::cancelled()->count())
                ->badgeColor('gray'),

            'active' => Tab::make('Active')
                ->modifyQueryUsing(fn (Builder $query) => $query->active())
                ->badge(MentorshipRequest::active()->count())
                ->badgeColor('primary'),
        ];
    }

    public function getDefaultActiveTab(): string
    {
        return 'pending';
    }
}