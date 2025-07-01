<?php

namespace App\Filament\Resources\BahanCairanLamaResource\Pages;

use App\Filament\Resources\BahanCairanLamaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBahanCairanLamas extends ListRecords
{
    protected static string $resource = BahanCairanLamaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
