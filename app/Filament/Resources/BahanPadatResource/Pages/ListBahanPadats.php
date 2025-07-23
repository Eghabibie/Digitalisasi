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
            Actions\Action::make('export')
                ->label('Export ke Excel')
                ->icon('heroicon-o-document-arrow-up')
                ->url(url('/export/bahan-padat')),
            Actions\CreateAction::make(),
        ];
    }
}
