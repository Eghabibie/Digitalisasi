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
            // ... di dalam method getHeaderActions()

Actions\Action::make('export')
    ->label('Export ke Excel')
    ->icon('heroicon-o-document-arrow-down')
    // Arahkan ke URL yang baru
    ->url('/export/bahan-cairan-lama'),
            Actions\CreateAction::make(),
        ];
    }
}
