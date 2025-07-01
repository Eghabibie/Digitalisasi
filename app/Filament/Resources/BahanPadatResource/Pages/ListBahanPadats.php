<?php

namespace App\Filament\Resources\BahanPadatResource\Pages;

use App\Filament\Resources\BahanPadatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBahanPadats extends ListRecords
{
    protected static string $resource = BahanPadatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Export')
                ->url(url('/export')),
            Actions\CreateAction::make(),
        ];
    }
}
