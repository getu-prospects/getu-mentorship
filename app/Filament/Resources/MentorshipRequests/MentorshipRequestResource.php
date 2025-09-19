<?php

namespace App\Filament\Resources\MentorshipRequests;

use App\Filament\Resources\MentorshipRequests\Pages\CreateMentorshipRequest;
use App\Filament\Resources\MentorshipRequests\Pages\EditMentorshipRequest;
use App\Filament\Resources\MentorshipRequests\Pages\ListMentorshipRequests;
use App\Filament\Resources\MentorshipRequests\Pages\ViewMentorshipRequest;
use App\Filament\Resources\MentorshipRequests\Schemas\MentorshipRequestForm;
use App\Filament\Resources\MentorshipRequests\Tables\MentorshipRequestsTable;
use App\Models\MentorshipRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MentorshipRequestResource extends Resource
{
    protected static ?string $model = MentorshipRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::InboxArrowDown;

    protected static ?string $navigationLabel = 'Mentorship Requests';

    protected static ?string $modelLabel = 'Mentorship Request';

    protected static ?string $pluralModelLabel = 'Mentorship Requests';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return MentorshipRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MentorshipRequestsTable::configure($table);
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
            'index' => ListMentorshipRequests::route('/'),
            'create' => CreateMentorshipRequest::route('/create'),
            'view' => ViewMentorshipRequest::route('/{record}'),
            'edit' => EditMentorshipRequest::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::pending()->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::pending()->count() > 0 ? 'warning' : null;
    }
}
