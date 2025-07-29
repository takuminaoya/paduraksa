<?php

namespace App\Livewire;

use App\Enum\KlasifikasiLaporan;
use App\Models\LaporanMasyarakat;
use Livewire\Component;

class HalamanUtama extends Component
{

    public $laporans = [];

    public function mount()
    {
        $cases = [];
        foreach (KlasifikasiLaporan::cases() as $c) {
            $cases[] = [
                "name" => $c->name,
                "total" => LaporanMasyarakat::where('klasifikasi', $c->name)->count()
            ];
        }

        $this->laporans = [
            "total" => LaporanMasyarakat::all()->count(),
            "klass" => $cases
        ];
    }

    public function render()
    {
        return view('livewire.halaman-utama');
    }
}
