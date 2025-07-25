<?php

namespace App\Filament\Resources\TypesResource\Pages;

use App\Filament\Resources\TypesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypes extends EditRecord
{
    protected static string $resource = TypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
