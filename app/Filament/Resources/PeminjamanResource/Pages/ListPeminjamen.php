<?php

namespace App\Filament\Resources\PeminjamanResource\Pages;

use App\Filament\Resources\PeminjamanResource;
use App\Models\Peminjaman;
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
        'all' => Tab::make('Semua')
                ->badge(Peminjaman::count()),

            'menunggu' => Tab::make('Menunggu Persetujuan')
                ->badge(Peminjaman::where('status', 'Menunggu Persetujuan')->count())
                ->badgeColor('warning') 
                ->query(fn ($query) => $query->where('status', 'Menunggu Persetujuan')),

            'dipinjam' => Tab::make('Sedang Dipinjam')
                ->badge(Peminjaman::where('status', 'Disetujui')->count())
                ->badgeColor('info')
                ->query(fn ($query) => $query->where('status', 'Disetujui')),

            'selesai' => Tab::make('Selesai')
                ->query(fn ($query) => $query->whereIn('status', ['Ditolak', 'Dikembalikan'])),
    ];
}
}
