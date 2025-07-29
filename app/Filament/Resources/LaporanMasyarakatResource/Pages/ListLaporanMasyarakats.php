<?php

namespace App\Filament\Resources\LaporanMasyarakatResource\Pages;

use App\Filament\Resources\LaporanMasyarakatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaporanMasyarakats extends ListRecords
{
    protected static string $resource = LaporanMasyarakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
