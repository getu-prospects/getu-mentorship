<?php

namespace App\Filament\Resources\Mentors\Pages;

use App\Filament\Resources\Mentors\MentorResource;
use App\Models\Mentor;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListMentors extends ListRecords
{
    protected static string $resource = MentorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Mentors'),
            'pending' => Tab::make('Pending Review')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending'))
                ->badge(fn () => Mentor::where('status', 'pending')->count())
                ->badgeColor('warning'),
            'approved' => Tab::make('Approved')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'approved'))
                ->badge(fn () => Mentor::where('status', 'approved')->count())
                ->badgeColor('success'),
            'suspended' => Tab::make('Suspended')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'suspended'))
                ->badge(fn () => Mentor::where('status', 'suspended')->count())
                ->badgeColor('danger'),
            'rejected' => Tab::make('Rejected')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'rejected'))
                ->badge(fn () => Mentor::where('status', 'rejected')->count())
                ->badgeColor('gray'),
            'with_community' => Tab::make('Community Members')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('join_online_community', true))
                ->badge(fn () => Mentor::where('join_online_community', true)->count())
                ->badgeColor('info'),
            'active_mentors' => Tab::make('Active (Has Sessions)')
                ->modifyQueryUsing(fn (Builder $query) => $query->has('mentorshipSessions'))
                ->badge(fn () => Mentor::has('mentorshipSessions')->count())
                ->badgeColor('primary'),
        ];
    }
}
