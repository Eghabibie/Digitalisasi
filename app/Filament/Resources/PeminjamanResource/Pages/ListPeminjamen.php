<?php

namespace App\Filament\Resources\PeminjamanResource\Pages;

use App\Filament\Resources\PeminjamanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;

class ListPeminjamen extends ListRecords
{
    protected static string $resource = PeminjamanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
{
    return [
        'all' => Tab::make('Semua'),
        'menunggu' => Tab::make('Menunggu Persetujuan')
            ->query(fn ($query) => $query->where('status', 'Menunggu Persetujuan')),
        'dipinjam' => Tab::make('Sedang Dipinjam')
            ->query(fn ($query) => $query->where('status', 'Disetujui')),
        'selesai' => Tab::make('Selesai')
            ->query(fn ($query) => $query->whereIn('status', ['Ditolak', 'Dikembalikan'])),
    ];
}
}
