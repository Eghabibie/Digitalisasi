<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BahanCairanLamaResource\Pages;
use App\Filament\Resources\BahanCairanLamaResource\RelationManagers;
use App\Models\BahanCairanLama;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Panel;
class BahanCairanLamaResource extends Resource
{
    protected static ?string $model = BahanCairanLama::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationLabel = 'Bahan Cair';
    protected static ?string $slug = 'Bahan_Cair';

    public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->sidebarFullyCollapsibleOnDesktop();
}

    public static ?string $label = 'Bahan cair' ;
    
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
                    ->label('Rumus Kimia')
                    ->placeholder("Masukan Rumus Kimia...."),
                TextInput::make('sisa_bahan')
                    ->required()
                    ->label('Sisa Bahan')
                    ->placeholder("Masukan Sisa Bhan...."),
                TextInput::make('nomor_cas')
                    ->required()
                    ->label('Nomor Cas')
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
                TextColumn::make('sisa_bahan')
                    ->searchable()
                    ->label('Sisa Bahan'),
                TextColumn::make('nomor_cas')
                    ->copyable()
                    ->copyMessage('Teks Tersalin')
                    ->searchable()
                    ->label('Nomor Cas'),
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
            'index' => Pages\ListBahanCairanLamas::route('/'),
            'create' => Pages\CreateBahanCairanLama::route('/create'),
            'edit' => Pages\EditBahanCairanLama::route('/{record}/edit'),
        ];
    }
}
