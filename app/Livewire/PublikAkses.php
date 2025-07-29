<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Tables\Table;
use App\Enum\TipeAutorisasi;
use App\Enum\KlasifikasiLaporan;
use App\Models\LaporanMasyarakat;
use Filament\Support\Colors\Color;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;

use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class PublikAkses extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(LaporanMasyarakat::query())
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('rahasia', 0);
            })
            ->striped()
            ->columns([
                TextColumn::make('klasifikasi')
                    ->formatStateUsing(fn($state): string => str_replace('_', ' ', $state))
                    ->searchable(),
                TextColumn::make('judul')
                    ->searchable(),
                TextColumn::make('tanggal_kejadian')
                    ->date()
                    ->sortable(),
                TextColumn::make('lokasi_kejadian')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('banjar_kejadian')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('nama')
                    ->formatStateUsing(fn($state, $record): string => $record->anonim == 1 ? 'Dirahasiakan' : $state)
                    ->searchable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->persistSortInSession()
            ->filters([
                SelectFilter::make('status')
                    ->options(TipeAutorisasi::class),
                SelectFilter::make('klasifikasi')
                    ->options(KlasifikasiLaporan::class)
            ])
            ->actions([
                ViewAction::make()
                    ->infolist([
                        Section::make('Informasi Laporan')
                            ->icon('tabler-plus')
                            ->description('Rincian isi laporan yang disampaikan oleh warga kepada pihak desa terkait berbagai permasalahan, keluhan, aspirasi, atau permintaan layanan.')
                            ->columns(2)
                            ->collapsible()
                            ->collapsed()
                            ->schema([
                                TextEntry::make('klasifikasi')
                                    ->formatStateUsing(fn($state): string => str_replace('_', ' ', $state)),
                                TextEntry::make('judul'),
                                TextEntry::make('isi')
                                    ->html()
                                    ->columnSpanFull(),
                                TextEntry::make('tanggal_kejadian')
                                    ->date(),
                                TextEntry::make('lokasi_kejadian'),
                                TextEntry::make('banjar_kejadian')
                                    ->prefix('Banjar '),
                                TextEntry::make('status')
                                    ->badge(),
                                ImageEntry::make('lampiran')
                                    ->columnSpanFull()
                                    ->disk('public'),
                            ]),

                        Section::make('Informasi Pelapor')
                            ->icon('tabler-user')
                            ->description('Data identitas yang berkaitan dengan warga yang menyampaikan laporan, pengaduan, atau aspirasi kepada pihak desa.')
                            ->columns(2)
                            ->collapsible()
                            ->schema([
                                TextEntry::make('nik')
                                    ->limit(8, end: '********'),
                                TextEntry::make('nama')
                                    ->formatStateUsing(fn($state, $record): string => $record->anonim == 1 ? 'Dirahasiakan' : $state),
                                TextEntry::make('alamat')
                                    ->columnSpanFull(),
                                TextEntry::make('tanggal_lahir'),
                                TextEntry::make('jenis_kelamin'),
                                TextEntry::make('no_telpon')
                                    ->limit(8, end: '********'),
                                TextEntry::make('pekerjaan'),
                                TextEntry::make('penyandang_disabilitas')
                                    ->badge()
                                    ->formatStateUsing(fn($record): string => $record->penyandang_disabilitas ? 'Iya' : 'Tidak'),
                            ])
                    ])
                    ->button()
                    ->color(Color::Rose)
            ])
            ->headerActions([]);
    }



    public function render()
    {
        return view('livewire.publik-akses');
    }
}
