<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeminjamanResource\Pages;
use App\Filament\Resources\PeminjamanResource\RelationManagers;
use App\Models\Peminjaman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;

class PeminjamanResource extends Resource
{
    protected static ?string $model = Peminjaman::class;
    protected static ?string $navigationGroup = 'Action Peminjaman';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('nama_peminjam')->searchable(),
            TextColumn::make('nim_peminjam')->searchable(),
            TextColumn::make('peminjamable.nama')->label('Barang Dipinjam'),
            TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                'Menunggu Persetujuan' => 'gray',
                'Disetujui' => 'warning',
                'Ditolak' => 'danger',
                'Dikembalikan' => 'success',
            }),
            TextColumn::make('tanggal_pinjam')->date()->sortable(),
        ])
        ->actions([
            Action::make('setujui')
                ->label('Setujui')
                ->color('success')->icon('heroicon-o-check-circle')
                ->action(function (Peminjaman $record) {
                    $record->update([
                        'status' => 'Disetujui',
                        'tanggal_pinjam' => now()
                    ]);
                })
                ->visible(fn (Peminjaman $record): bool => $record->status === 'Menunggu Persetujuan'),

            Action::make('tolak')
                ->label('Tolak')
                ->color('danger')->icon('heroicon-o-x-circle')
                ->action(fn (Peminjaman $record) => $record->update(['status' => 'Ditolak']))
                ->visible(fn (Peminjaman $record): bool => $record->status === 'Menunggu Persetujuan'),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPeminjamen::route('/'),
            'create' => Pages\CreatePeminjaman::route('/create'),
            'edit' => Pages\EditPeminjaman::route('/{record}/edit'),
        ];
    }
}
