<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BahanPadatResource\Pages;
use App\Filament\Resources\BahanPadatResource\RelationManagers;
use App\Models\BahanPadat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Panel; 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BahanPadatResource extends Resource
{
    protected static ?string $model = BahanPadat::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube-transparent';
    protected static ?string $navigationLabel = 'Bahan Padat';
    protected static ?string $slug = 'Bahan_Padat';
    protected static ?int $navigationSort = 2;

    public static ?string $label = 'Bahan Padat' ;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->required()
                    ->label('Nama Cairan')
                    ->placeholder("Masukan Nama Cairan...."),
                TextInput::make('rumus_kimia')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->label('Rumus Kimia')
                    ->placeholder("Masukan Rumus Kimia...."),
                TextInput::make('unit')
                ->label('Satuan (g, mL, dll)')
                ->required(),
                TextInput::make('jumlah')
                    ->required()
                    ->label('Jumlah')
                    ->placeholder("Masukan Jumlah Bahan...."),
                TextInput::make('nomor_cas')
                    ->required()
                    ->label('Nomor CAS')
                    ->placeholder("Masukan Nomor CAS...."),
                TextInput::make('letak')
                    ->required()
                    ->label('Letak Barang')
                    ->placeholder("Masukan Letak Barang...."),
                TextInput::make('pemilik')
                    ->required()
                    ->label('Pemilik')
                    ->placeholder("Masukan Nama Pemilik...."),
                TextInput::make('tahun_pengadaan')
                    ->required()
                    ->label('Tahun Pengadaan')
                    ->placeholder("Masukan Tahun Pengadaan...."),
                TextInput::make('expired')
                    ->required()
                    ->label('Expired')
                    ->placeholder("Masukan Tanggal Expired...."),
                TextInput::make('merek')
                    ->required()
                    ->label('Merek')
                    ->placeholder("Masukan Nama Merek...."),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->sortable()
                    ->label('Nama Bahan')
                    ->searchable(),
                TextColumn::make('rumus_kimia')
                    ->searchable()
                    ->label('Rumus Kimia'),
                TextColumn::make('jumlah')
                    ->label('Stok Tersedia')
                    ->formatStateUsing(fn ($state, $record) => "{$state} {$record->unit}")
                    ->sortable()
                    ->searchable(query: function ($query, $search) {
                        return $query->where('jumlah', 'like', "%{$search}%");
                    }),
                TextColumn::make('nomor_cas')
                    ->copyable()
                    ->copyMessage('Teks Tersalin')
                    ->searchable()
                    ->label('Nomor CAS'),
                TextColumn::make('letak')
                    ->searchable()
                    ->label('Letak'),
                TextColumn::make('pemilik')
                    ->searchable()
                    ->label('Pemilik'),
                TextColumn::make('tahun_pengadaan')
                    ->searchable()
                    ->label('Tahun Pengadaan'),
                TextColumn::make('expired')
                    ->searchable()
                    ->label('Expired'),
                TextColumn::make('merek')
                    ->searchable()
                    ->label('Merek'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListBahanPadats::route('/'),
            'create' => Pages\CreateBahanPadat::route('/create'),
            'edit' => Pages\EditBahanPadat::route('/{record}/edit'),
        ];
    }
}
