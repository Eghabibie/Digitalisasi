<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlatResource\Pages;
use App\Filament\Resources\AlatResource\RelationManagers;
use App\Models\Alat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;

class AlatResource extends Resource
{
    protected static ?string $model = Alat::class;

    protected static ?string $navigationIcon = 'heroicon-o-funnel';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->required()
                    ->label('Nama Alat')
                    ->placeholder("Masukan Nama Alat...."),
                FileUpload::make('images')
                    ->label('Gambar')
                    ->image()
                    ->disk('public')
                    ->directory('alat-images')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ]),
                TextInput::make('volume')
                    ->required()
                    ->label('Volume')
                    ->placeholder("Masukan Volume Alat...."),
                TextInput::make('kondisi')
                    ->required()
                    ->label('Kondisi Alat')
                    ->placeholder("Masukan Kondisi Alat...."),
                TextInput::make('stok')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->label('Stok Tersedia')
                    ->placeholder("Masukan jumlah stok...."),
                TextInput::make('merek')
                    ->required()
                    ->label('Merek Alat')
                    ->placeholder("Masukan Merek Alat...."),
                TextInput::make('tahun_pengadaan')
                    ->required()
                    ->label('Tahun Pengadaan')
                    ->placeholder("Masukan Tahun Pengadaan...."),

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
                    ->label('Gambar'),
                TextColumn::make('volume')
                    ->searchable()
                    ->label('Volume'),
                TextColumn::make('kondisi')
                    ->searchable()
                    ->label('Kondisi'),
                TextColumn::make('stok')
                    ->label('Stok Tersedia')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('merek')
                    ->searchable()
                    ->label('Merek'),
                TextColumn::make('tahun_pengadaan')
                    ->searchable()
                    ->label('Tahun Pengadaan'),

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
