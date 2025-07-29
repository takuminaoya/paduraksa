<?php

namespace App\Filament\Resources\LaporanMasyarakatResource\Pages;

use Carbon\Carbon;
use App\Enum\TipeAutorisasi;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use App\Models\LaporanAutorisasi;
use Filament\Actions\ActionGroup;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\LaporanMasyarakatResource;

class ViewLaporanMasyarakat extends ViewRecord
{
    protected static string $resource = LaporanMasyarakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make([
                Action::make('Reset Laporan')
                    ->icon('tabler-restore')
                    ->hidden(fn(): bool => !user()->hasRole('super_admin'))
                    ->requiresConfirmation()
                    ->action(function ($record): void {
                        $record->status = 'AKTIF';
                        $record->save();


                        $auth_lapors = $record->autorisasis;

                        foreach ($auth_lapors as $al) {
                            $al->delete();
                        }

                        Notification::make()
                            ->title('Laporan telah direset menjadi aktif dan semua autoritas yang ada telah dihapus.')
                            ->success()
                            ->send();
                    }),
                EditAction::make()
                    ->icon('tabler-edit'),
                Action::make('verifikasi_laporan')
                    ->color(Color::Blue)
                    ->icon('tabler-signature')
                    ->authorize('verifikasi_laporan::masyarakats')
                    ->disabled(fn($record): bool => $record->autorisasi(TipeAutorisasi::VERIFIKASI))
                    ->requiresConfirmation()
                    ->action(
                        function ($record): void {
                            $user = Auth::user();
                            LaporanAutorisasi::create([
                                'user_id' => $user->id,
                                'laporan_masyarakat_id' => $record->id,
                                'tipe_autorisasi' => TipeAutorisasi::VERIFIKASI,
                                'tanggal_autorisasi' => Carbon::now()
                            ]);

                            $record->status = TipeAutorisasi::VERIFIKASI;
                            $record->save();

                            Notification::make()
                                ->title('Laporan telah terverifikasi oleh ' . $user->name)
                                ->success()
                                ->actions([
                                    Action::make('view')
                                        ->url($record->id)
                                        ->button()
                                        ->markAsUnread(),
                                ])
                                ->sendToDatabase(superAdmin())
                                ->send()
                            ;
                        }
                    ),
                Action::make('tindak_lanjut_laporan')
                    ->icon('tabler-trekking')
                    ->color(Color::Emerald)
                    ->authorize('tindak_lanjut_laporan::masyarakats')
                    ->disabled(fn($record): bool => $record->autorisasi(TipeAutorisasi::TINDAK_LANJUT))
                    ->form([
                        MarkdownEditor::make('deskripsi')
                            ->required(),
                        FileUpload::make('lampiran')
                            ->visibility('public')
                            ->directory('autoritas_lampiran')
                            ->disk('public')
                            ->multiple()
                    ])
                    ->action(
                        function ($data, $record): void {
                            $user = Auth::user();
                            LaporanAutorisasi::create([
                                'user_id' => $user->id,
                                'laporan_masyarakat_id' => $record->id,
                                'tipe_autorisasi' => TipeAutorisasi::TINDAK_LANJUT,
                                'tanggal_autorisasi' => Carbon::now(),
                                'deskripsi' => $data['deskripsi'],
                                'lampiran' => $data['lampiran'],
                            ]);

                            $record->status = TipeAutorisasi::TINDAK_LANJUT;
                            $record->save();

                            Notification::make()
                                ->title('Laporan telah ditindak lanjuti oleh ' . $user->name)
                                ->actions([
                                    Action::make('view')
                                        ->url($record->id)
                                        ->button()
                                        ->markAsUnread(),
                                ])
                                ->success()
                                ->sendToDatabase(superAdmin())
                                ->send();
                        }
                    ),
                Action::make('batal_laporan')
                    ->icon('tabler-x')
                    ->color(Color::Red)
                    ->authorize('batal_laporan::masyarakats')
                    ->disabled(fn($record): bool => $record->autorisasi(TipeAutorisasi::BATAL))
                    ->form([
                        MarkdownEditor::make('deskripsi')
                            ->label('alasan')
                            ->required(),
                    ])
                    ->action(
                        function ($data, $record): void {
                            $user = Auth::user();
                            LaporanAutorisasi::create([
                                'user_id' => $user->id,
                                'laporan_masyarakat_id' => $record->id,
                                'tipe_autorisasi' => TipeAutorisasi::BATAL,
                                'tanggal_autorisasi' => Carbon::now(),
                                'deskripsi' => $data['deskripsi'],
                            ]);

                            $record->status = TipeAutorisasi::BATAL;
                            $record->save();

                            Notification::make()
                                ->title('Laporan telah dibatalkan oleh ' . $user->name)
                                ->actions([
                                    Action::make('view')
                                        ->url($record->id)
                                        ->button()
                                        ->markAsUnread(),
                                ])
                                ->success()
                                ->sendToDatabase(superAdmin())
                                ->send();
                        }
                    ),
                Action::make('selesai_laporan')
                    ->icon('tabler-checks')
                    ->color(Color::Green)
                    ->authorize('selesai_laporan::masyarakats')
                    ->disabled(fn($record): bool => $record->autorisasi(TipeAutorisasi::SELESAI))
                    ->form([
                        MarkdownEditor::make('deskripsi')
                            ->required(),
                        FileUpload::make('lampiran')
                            ->visibility('public')
                            ->directory('autoritas_lampiran')
                            ->disk('public')
                            ->multiple()
                    ])
                    ->action(
                        function ($data, $record): void {
                            $user = Auth::user();
                            LaporanAutorisasi::create([
                                'user_id' => $user->id,
                                'laporan_masyarakat_id' => $record->id,
                                'tipe_autorisasi' => TipeAutorisasi::SELESAI,
                                'tanggal_autorisasi' => Carbon::now(),
                                'deskripsi' => $data['deskripsi'],
                                'lampiran' => $data['lampiran'],
                            ]);

                            $record->status = TipeAutorisasi::SELESAI;
                            $record->save();

                            Notification::make()
                                ->title('Laporan telah diselesaikan oleh ' . $user->name)
                                ->actions([
                                    Action::make('view')
                                        ->url($record->id)
                                        ->button()
                                        ->markAsUnread(),
                                ])
                                ->success()
                                ->sendToDatabase(superAdmin())
                                ->send();
                        }
                    ),
            ])

        ];
    }
}
