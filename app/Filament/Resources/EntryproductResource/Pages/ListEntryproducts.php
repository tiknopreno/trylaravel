<?php

namespace App\Filament\Resources\EntryproductResource\Pages;

use App\Filament\Resources\EntryproductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEntryproducts extends ListRecords
{
    protected static string $resource = EntryproductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
