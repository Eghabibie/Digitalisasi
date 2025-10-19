<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeminjamanResource\Pages;
use App\Models\Peminjaman;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;

class PeminjamanResource extends Resource
{
    protected static ?string $model = Peminjaman::class;
    protected static ?string $navigationGroup = 'Action Peminjaman';
    protected static ?string $navigationIcon = 'heroicon-o-folder-open';

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'Menunggu Persetujuan')->count();
        return $count > 0 ? $count : null;
    }

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
                TextColumn::make('no_hp')->label('No. HP')->searchable(),
                TextColumn::make('peminjamable.nama')->label('Barang Dipinjam'),
                TextColumn::make('jumlah')
                    ->label('Jumlah Dipinjam')
                    ->formatStateUsing(function ($state, $record) {
                        if ($record->peminjamable_type !== 'App\\Models\\Alat' && $record->peminjamable) {
                            return $state . ' ' . $record->peminjamable?->unit;
                        }
                        return $state;
                    }),
                TextColumn::make('status')->badge()->color(fn(string $state): string => match ($state) {
                    'Menunggu Persetujuan' => 'gray',
                    'Disetujui' => 'warning',
                    'Ditolak' => 'danger',
                    'Dikembalikan' => 'success',
                }),
                TextColumn::make('tanggal_pinjam')->date(),
                TextColumn::make('tanggal_kembali')->date(),
            ])
            ->actions([
                Action::make('setujui')
                    ->label('Setujui')
                    ->color('success')->icon('heroicon-o-check-circle')
                    ->action(function (Peminjaman $record) {
                        $record->update(['status' => 'Disetujui', 'tanggal_pinjam' => now()]);
                    })
                    ->visible(fn(Peminjaman $record): bool => $record->status === 'Menunggu Persetujuan'),
                Action::make('tolak')
                    ->label('Tolak')
                    ->color('danger')->icon('heroicon-o-x-circle')
                    ->action(function (Peminjaman $record) {
                        $item = $record->peminjamable;
                        $jumlah_batal = $record->jumlah;
                        if ($record->peminjamable_type === 'App\\Models\\Alat') {
                            $item->increment('stok', $jumlah_batal);
                        } else {
                            $item->increment('sisa_bahan', $jumlah_batal);
                        }

                        $record->update(['status' => 'Ditolak']);
                    })
                    ->visible(fn(Peminjaman $record): bool => $record->status === 'Menunggu Persetujuan'),

                Action::make('kembalikan')
                    ->label('Tandai Telah DiKembalikan')
                    ->color('info')->icon('heroicon-o-archive-box')
                    ->action(function (Peminjaman $record) {
                        $item = $record->peminjamable;
                        $jumlah_kembali = $record->jumlah;
                        if ($record->peminjamable_type === 'App\\Models\\Alat') {
                            $item->increment('stok', $jumlah_kembali);
                        } else {
                            $item->increment('sisa_bahan', $jumlah_kembali);
                        }

                        $record->update(['status' => 'Dikembalikan', 'tanggal_kembali' => now()]);
                    })
                    ->visible(fn(Peminjaman $record): bool => $record->status === 'Disetujui'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->poll('5s');
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
