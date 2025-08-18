<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BahanCairanLamaResource\Pages;
use App\Models\BahanCairanLama;
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

class BahanCairanLamaResource extends Resource
{
    protected static ?string $model = BahanCairanLama::class;
    protected static ?string $navigationIcon = 'heroicon-o-beaker';
    protected static ?string $navigationLabel = 'Bahan Cair';
    protected static ?string $slug = 'Bahan_Cair';
    protected static ?int $navigationSort = 3;
    public static ?string $label = 'Bahan cair';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Bahan Kimia')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('nama')
                                ->required()
                                ->label('Nama Cairan')
                                ->placeholder("Masukan Nama Cairan"),
                            TextInput::make('rumus_kimia')
                                ->label('Rumus Kimia')
                                ->placeholder("Contoh: H2O"),
                            TextInput::make('nomor_cas')
                                ->label('Nomor CAS')
                                ->placeholder("Contoh: 7732-18-5"),
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
                                    'mL' => 'mL',
                                    'L' => 'L',
                                    'cc' => 'cc',
                                ])
                                ->required(),
                            TextInput::make('letak')
                                ->required()
                                ->label('Letak Penyimpanan')
                                ->placeholder("Contoh: Lemari B, Rak 2"),
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
                                ->placeholder("Contoh: 2024"),
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
                    ->formatStateUsing(function (?string $state): string {
                        if (empty($state)) {
                            return '-';
                        }
                        try {
                            return Carbon::parse($state)->translatedFormat('d F Y');
                        } catch (\Exception $e) {
                            return 'Format Tanggal Salah!';
                        }
                    })
                    ->color(function (?string $state): string {
                        if (empty($state)) {
                            return 'gray';
                        }
                        try {
                            return Carbon::parse($state)->isPast() ? 'danger' : 'success';
                        } catch (\Exception $e) {
                            return 'gray';
                        }
                    })
                    ->icon(function (?string $state): string {
                        if (empty($state)) {
                            return 'heroicon-o-question-mark-circle';
                        }
                        try {
                            return Carbon::parse($state)->isPast() ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle';
                        } catch (\Exception $e) {
                            return 'heroicon-o-question-mark-circle';
                        }
                    })
                    ->sortable(),

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
            'index' => Pages\ListBahanCairanLamas::route('/'),
            'create' => Pages\CreateBahanCairanLama::route('/create'),
            'edit' => Pages\EditBahanCairanLama::route('/{record}/edit'),
        ];
    }
}
