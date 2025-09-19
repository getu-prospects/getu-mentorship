<?php

namespace App\Filament\Resources\Mentors;

use App\Filament\Resources\Mentors\Pages\CreateMentor;
use App\Filament\Resources\Mentors\Pages\EditMentor;
use App\Filament\Resources\Mentors\Pages\ListMentors;
use App\Filament\Resources\Mentors\Schemas\MentorForm;
use App\Filament\Resources\Mentors\Tables\MentorsTable;
use App\Models\Mentor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
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
