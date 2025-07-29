<?php

use App\Livewire\HalamanNotifikasi;
use App\Livewire\HalamanUtama;
use App\Livewire\PetujukLaporan;
use App\Livewire\PublikAkses;
use App\Livewire\TentangLaporan;
use Illuminate\Support\Facades\Route;

Route::get('/', HalamanUtama::class)->name('home');
Route::get('/notif/sukses/{uuid}', HalamanNotifikasi::class)->name('notif.sukses');
Route::get('/tentang', TentangLaporan::class)->name('tentang');
Route::get('/petunjuk', PetujukLaporan::class)->name('petunjuk');
Route::get('/publik', PublikAkses::class)->name('publik');
