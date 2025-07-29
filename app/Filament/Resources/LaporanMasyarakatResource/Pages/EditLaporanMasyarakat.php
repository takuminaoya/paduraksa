<?php

namespace App\Filament\Resources\LaporanMasyarakatResource\Pages;

use App\Filament\Resources\LaporanMasyarakatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporanMasyarakat extends EditRecord
{
    protected static string $resource = LaporanMasyarakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getRelationManagers(): array
    {
        return [];
    }
}
