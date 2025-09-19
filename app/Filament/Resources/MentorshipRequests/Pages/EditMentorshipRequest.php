<?php

namespace App\Filament\Resources\MentorshipRequests\Pages;

use App\Filament\Resources\MentorshipRequests\MentorshipRequestResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMentorshipRequest extends EditRecord
{
    protected static string $resource = MentorshipRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
