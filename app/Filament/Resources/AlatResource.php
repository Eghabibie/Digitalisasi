<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlatResource\Pages;
use App\Models\Alat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;

class AlatResource extends Resource
{
    protected static ?string $model = Alat::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Utama Alat')
                    ->description('Masukan detail spesifikasi untuk alat laboratorium.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('nama')
                                ->required()
                                ->label('Nama Alat')
                                ->placeholder("Contoh: Gelas Beaker"),
                            TextInput::make('merek')
                                ->required()
                                ->label('Merek Alat')
                                ->placeholder("Contoh: Pyrex"),
                            TextInput::make('volume')
                                ->label('Volume')
                                ->placeholder("Contoh: 250 ml"),
                            TextInput::make('kondisi')
                                ->required()
                                ->label('Kondisi Alat')
                                ->placeholder("Contoh: Baik, Rusak Ringan"),
                            TextInput::make('stok')
                                ->required()
                                ->numeric()
                                ->minValue(0)
                                ->label('Stok Tersedia')
                                ->placeholder("Masukan jumlah stok"),
                            TextInput::make('tahun_pengadaan')
                                ->required()
                                ->label('Tahun Pengadaan')
                                ->placeholder("Contoh: 2023"),
                        ]),
                    ]),

                Section::make('Gambar Alat')
                    ->schema([
                        FileUpload::make('images')
                            ->label('Gambar')
                            ->multiple()
                            ->reorderable()
                            ->appendFiles()
                            ->image()
                            ->disk('public')
                            ->directory('alat-images')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->sortable()
                    ->label('Nama Alat')
                    ->searchable(),
                ImageColumn::make('images')
                    ->disk('public')
                    ->label('Gambar')
                    ->getStateUsing(function ($record) {
                        $images = $record->images;
                        if (is_string($images)) {
                            return [$images];
                        }
                        return $images;
                    })
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText(),

                TextColumn::make('stok')
                    ->label('Stok')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('kondisi')
                    ->searchable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Baik' => 'success',
                        'Rusak Ringan' => 'warning',
                        'Rusak Berat' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('merek')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tahun_pengadaan')
                    ->searchable()
                    ->label('Tahun')
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlats::route('/'),
            'create' => Pages\CreateAlat::route('/create'),
            'edit' => Pages\EditAlat::route('/{record}/edit'),
        ];
    }
}
