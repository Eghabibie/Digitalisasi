<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BahanPadatResource\Pages;
use App\Models\BahanPadat;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BahanPadatResource extends Resource
{
    protected static ?string $model = BahanPadat::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube-transparent';
    protected static ?string $navigationLabel = 'Bahan Padat';
    protected static ?string $slug = 'Bahan_Padat';
    protected static ?int $navigationSort = 2;
    public static ?string $label = 'Bahan Padat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Bahan Kimia Padat')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('nama')
                                ->required()
                                ->label('Nama Bahan')
                                ->placeholder("Masukan Nama Bahan Padat"),
                            TextInput::make('rumus_kimia')
                                ->label('Rumus Kimia')
                                ->placeholder("Contoh: NaCl"),
                            TextInput::make('nomor_cas')
                                ->label('Nomor CAS')
                                ->placeholder("Contoh: 7647-14-5"),
                            TextInput::make('merek')
                                ->label('Merek')
                                ->placeholder("Contoh: Merck"),
                        ]),
                    ]),
                Section::make('Informasi Stok dan Penyimpanan')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('sisa_bahan')
                                ->required()
                                ->numeric()
                                ->label('Jumlah Bahan'),
                            Select::make('unit')
                                ->label('Satuan')
                                ->options([
                                    'g' => 'g (gram)',
                                    'kg' => 'kg (kilogram)',
                                    'mg' => 'mg (miligram)',
                                    'pcs' => 'pcs (pieces)',
                                ])
                                ->required(),
                            TextInput::make('letak')
                                ->required()
                                ->label('Letak Penyimpanan')
                                ->placeholder("Contoh: Lemari A, Rak 1"),
                            DatePicker::make('expired')
                                ->label('Tanggal kadaluarsa')
                                ->required(),
                        ]),
                    ]),
                Section::make('Informasi Pengadaan')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('pemilik')
                                ->label('Pemilik')
                                ->placeholder("Masukan Nama Pemilik"),
                            TextInput::make('tahun_pengadaan')
                                ->numeric()
                                ->label('Tahun Pengadaan')
                                ->placeholder("Contoh: 2023"),
                        ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->sortable()
                    ->searchable()
                    ->label('Nama Bahan'),
                TextColumn::make('rumus_kimia')
                    ->searchable()
                    ->label('Rumus Kimia'),
                TextColumn::make('sisa_bahan')
                    ->label('Sisa')
                    ->searchable()
                    ->formatStateUsing(fn($state, $record) => "{$state} {$record->unit}")
                    ->sortable(),
                TextColumn::make('expired')
                    ->label('Tanggal kadaluarsa')
                    ->date('d M Y')
                    ->sortable()
                    ->color(
                        fn(string $state): string =>
                        Carbon::parse($state)->isPast() ? 'danger' : 'success'
                    )
                    ->icon(
                        fn(string $state): string =>
                        Carbon::parse($state)->isPast() ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle'
                    ),
                TextColumn::make('nomor_cas')
                    ->copyable()
                    ->searchable()
                    ->label('Nomor CAS')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('letak')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('pemilik')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('merek')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
        return [];
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
