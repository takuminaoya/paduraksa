<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Enum\BanjarEnum;
use Filament\Forms\Form;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Enum\KlasifikasiLaporan;
use App\Models\LaporanMasyarakat;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class CreateLaporan extends Component implements HasForms, HasActions
{

    use InteractsWithForms;
    use InteractsWithActions;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->components([
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
                ])->submitAction(new HtmlString('<button class="w-full py-2 px-5 rounded-lg btn-lapor" type="submit"><x-tabler-plus />Laporkan Tautan</button>'))

                    ->columnSpanFull()
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $lap = LaporanMasyarakat::create($data);

        Notification::make()
            ->title('Laporan Baru dengan nama ' . $data['nama'] . 'telah masuk.')
            ->success()
            ->sendToDatabase(User::find(1));

        $this->redirect('/notif/sukses/' . $lap->uuid, navigate: true);
    }

    public function render()
    {
        return view('livewire.create-laporan');
    }
}
