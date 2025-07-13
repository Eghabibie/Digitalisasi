<?php

namespace App\Filament\Resources\BahanCairanLamaResource\Pages;

use App\Filament\Resources\BahanCairanLamaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBahanCairanLama extends CreateRecord
{
    protected static string $resource = BahanCairanLamaResource::class;
    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
}
