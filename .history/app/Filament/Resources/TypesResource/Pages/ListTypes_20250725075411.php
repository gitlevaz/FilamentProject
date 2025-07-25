<?php

namespace App\Filament\Resources\TypesResource\Pages;

use App\Filament\Resources\TypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypes extends ListRecords
{
    protected static string $resource = App\Filament\Resources\TypesResource\Pages\TypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
