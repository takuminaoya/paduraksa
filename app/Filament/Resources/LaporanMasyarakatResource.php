<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Enum\BanjarEnum;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\DummyLaporanGenerator;
use App\Enum\KlasifikasiLaporan;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use App\Models\LaporanMasyarakat;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Wizard\Step;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LaporanMasyarakatResource\Pages;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use App\Filament\Resources\LaporanMasyarakatResource\RelationManagers;
use App\Filament\Resources\LaporanMasyarakatResource\RelationManagers\AutorisasiRelationManager;

class LaporanMasyarakatResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = LaporanMasyarakat::class;

    protected static ?string $navigationIcon = 'tabler-file-type-doc';
    protected static ?string  $navigationGroup = 'Laporan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('uuid')
                    ->default(fn(): string => Str::uuid()),
                Wizard::make([
                    Step::make('Data Laporan')
                        ->description('Informasi Laporan Anda')
                        ->icon('tabler-file-type-doc')
                        ->schema([
                            TextInput::make('judul')
                                ->required()
                                ->columnSpanFull(),
                            MarkdownEditor::make('isi')
                                ->required()
                                ->fileAttachmentsDisk('public')
                                ->fileAttachmentsVisibility('public')
                                ->fileAttachmentsDirectory('attachments')
                                ->columnSpanFull(),
                            DatePicker::make('tanggal_kejadian')
                                ->default(fn() => Carbon::now())
                                ->required(),
                            TextInput::make('lokasi_kejadian')
                                ->required()
                                ->columnSpanFull(),
                            Select::make('banjar_kejadian')
                                ->prefix('Br. ')
                                ->required()
                                ->columnSpanFull()
                                ->options(BanjarEnum::class),
                            Select::make('klasifikasi')
                                ->required()
                                ->columnSpanFull()
                                ->options(KlasifikasiLaporan::class),
                            Toggle::make('anonim'),
                            Toggle::make('rahasia'),
                            FileUpload::make('lampiran')
                                ->imageEditor()
                                ->disk('public')
                                ->visibility('public')
                                ->directory('lampiran')
                                ->columnSpanFull()
                                ->nullable()

                        ])
                        ->columns(2),
                    Step::make('Data Pelapor')
                        ->description('Informasi Diri Anda')
                        ->icon('tabler-user')
                        ->schema([
                            TextInput::make('nik')
                                ->minLength(16)
                                ->maxLength(16)
                                ->required(),
                            TextInput::make('nama')
                                ->required(),
                            TextInput::make('judul')
                                ->required()
                                ->columnSpanFull(),
                            Textarea::make('alamat')
                                ->required()
                                ->columnSpanFull(),
                            DatePicker::make('tanggal_lahir')
                                ->required(),
                            Select::make('jenis_kelamin')
                                ->options([
                                    'rahasia' => 'Memilih Tidak Menyebutkan',
                                    'perempuan' => 'Perempuan',
                                    'laki-laki' => 'Laki Laki',
                                ])
                                ->required(),
                            TextInput::make('no_telpon')
                                ->prefix("+62")
                                ->required(),
                            TextInput::make('pekerjaan')
                                ->required(),
                            Toggle::make('penyandang_disabilitas'),
                        ])
                        ->columns(2),
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('klasifikasi')
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
                ToggleColumn::make('anonim'),
                ToggleColumn::make('rahasia')
                    ->searchable(),
                TextColumn::make('nama')
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
            ->filters([
                SelectFilter::make('klasifikasi')
                    ->options(KlasifikasiLaporan::class)
            ])
            ->headerActions([
                Action::make('Generate Dummy Data')
                    ->requiresConfirmation()
                    ->icon('tabler-windmill')
                    ->color(Color::Blue)
                    ->action(
                        function (): void {
                            $gen = new DummyLaporanGenerator(5);
                            $gen->generate();
                        }
                    )
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()
                        ->icon('tabler-edit'),
                    EditAction::make()
                        ->color(Color::Orange)
                        ->icon('tabler-x'),

                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Laporan')
                    ->description('Rincian isi laporan yang disampaikan oleh warga kepada pihak desa terkait berbagai permasalahan, keluhan, aspirasi, atau permintaan layanan.')
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        TextEntry::make('uuid')
                            ->copyable()
                            ->icon('tabler-copy')
                            ->label('UUID'),
                        TextEntry::make('klasifikasi'),
                        TextEntry::make('judul'),
                        TextEntry::make('isi')
                            ->html()
                            ->columnSpanFull(),
                        TextEntry::make('tanggal_kejadian')
                            ->date(),
                        TextEntry::make('lokasi_kejadian'),
                        TextEntry::make('banjar_kejadian'),
                        TextEntry::make('anonim')
                            ->badge()
                            ->formatStateUsing(fn($record): string => $record->anonim ? 'Dirahasiakan' : 'Publik'),
                        TextEntry::make('rahasia')
                            ->badge()
                            ->formatStateUsing(fn($record): string => $record->rahasia ? 'Dirahasiakan' : 'Publik'),
                        TextEntry::make('status')
                            ->badge(),
                        ImageEntry::make('lampiran')
                            ->columnSpanFull()
                            ->disk('public'),
                    ]),

                Section::make('Informasi Pelapor')
                    ->description('Data identitas yang berkaitan dengan warga yang menyampaikan laporan, pengaduan, atau aspirasi kepada pihak desa.')
                    ->columns(2)
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        TextEntry::make('nik'),
                        TextEntry::make('nama'),
                        TextEntry::make('alamat'),
                        TextEntry::make('tanggal_lahir'),
                        TextEntry::make('jenis_kelamin'),
                        TextEntry::make('no_telpon'),
                        TextEntry::make('pekerjaan'),
                        TextEntry::make('penyandang_disabilitas')
                            ->badge()
                            ->formatStateUsing(fn($record): string => $record->penyandang_disabilitas ? 'Iya' : 'Tidak'),
                        TextEntry::make('created_at')
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->dateTime(),
                    ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AutorisasiRelationManager::class
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
            'verifikasi',
            'tindak_lanjut',
            'selesai',
            'batal',
            'hapus_autoritas'
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaporanMasyarakats::route('/'),
            'create' => Pages\CreateLaporanMasyarakat::route('/create'),
            'view' => Pages\ViewLaporanMasyarakat::route('/{record}'),
            'edit' => Pages\EditLaporanMasyarakat::route('/{record}/edit'),
        ];
    }
}
