<?php

namespace App\Filament\Resources\BahanPadatResource\Pages;

use App\Filament\Resources\BahanPadatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBahanPadat extends EditRecord
{
    protected static string $resource = BahanPadatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
