<?php

namespace App\Filament\Resources\BahanCairanLamaResource\Pages;

use App\Filament\Resources\BahanCairanLamaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBahanCairanLama extends EditRecord
{
    protected static string $resource = BahanCairanLamaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
