<?php

namespace App\Livewire;

use App\Models\LaporanMasyarakat;
use Livewire\Component;

class HalamanNotifikasi extends Component
{
    public $laporan;

    public function mount($uuid)
    {
        $this->laporan = LaporanMasyarakat::where('uuid', $uuid)->first();
    }

    public function render()
    {
        return view('livewire.halaman-notifikasi');
    }
}
