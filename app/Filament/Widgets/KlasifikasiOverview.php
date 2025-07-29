<?php

namespace App\Filament\Widgets;

use App\Enum\KlasifikasiLaporan;
use App\Models\LaporanMasyarakat;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KlasifikasiOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $stats = [];
        foreach (KlasifikasiLaporan::cases() as $k) {
            $count = LaporanMasyarakat::where('klasifikasi', $k->name)->count();
            $stats[] = Stat::make('TOTAL ' . str_replace("_", " ", $k->name), $count . " Laporan");
        }

        return $stats;
    }
}
