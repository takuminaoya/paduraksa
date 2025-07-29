<?php

namespace App\Filament\Resources\LaporanMasyarakatResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class AutorisasiRelationManager extends RelationManager
{
    protected static string $relationship = 'autorisasis';
    protected static ?string $title = 'Daftar Autorisasi Dokumen';

    public function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->description('sebuah dokumen atau sistem yang memuat informasi mengenai individu, jabatan, atau sistem yang memiliki hak atau wewenang tertentu untuk melakukan suatu tindakan atau mengakses data dalam sebuah sistem.')
            ->recordTitleAttribute('user.name')
            ->columns([
                TextColumn::make('tanggal_autorisasi')
                    ->date()
                    ->since()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Nama Autoritas')
                    ->searchable(),
                TextColumn::make('laporan.judul')
                    ->searchable(),
                TextColumn::make('tipe_autorisasi')
                    ->description(
                        function ($record): string {
                            $res = $record->deskripsi;
                            if ($record->tipe_autorisasi == "BATAL") {
                                $res = 'Alasan : ' . $record->deskripsi;
                            }

                            return $res ? $res : "-";
                        }
                    )
                    ->badge()
                    ->wrap(),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->actions([
                DeleteAction::make()
                    ->hidden(fn(): bool => !user()->hasRole('super_admin')),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->hidden(fn(): bool => !user()->hasRole('super_admin')),
                ]),
            ]);
    }
}
