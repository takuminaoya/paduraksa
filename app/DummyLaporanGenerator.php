<?php

namespace App;

use App\Enum\KlasifikasiLaporan;
use Illuminate\Support\Str;
use App\Models\Ungasan\Penduduk;
use App\Models\Ungasan\Pengguna;
use App\Models\LaporanMasyarakat;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;
use Illuminate\Support\Carbon;

class DummyLaporanGenerator
{

    public $jumlah = 1;
    public $dummyTitles = [
        'Permohonan Pembuatan KTP Baru',
        'Permohonan Perbaikan Data KK',
        'Permohonan Surat Keterangan Domisili',
        'Permohonan SKTM (Surat Keterangan Tidak Mampu)',
        'Permohonan Surat Pindah',
        'Permohonan Akta Kelahiran',
        'Permohonan Akta Kematian',
        'Permohonan Surat Nikah Adat',
        'Permohonan Surat Belum Menikah',
        'Permohonan Pengantar SKCK',
        'Permohonan Perbaikan Jalan Lingkungan',
        'Permohonan Lampu Jalan',
        'Permohonan Bantuan Pembangunan Balai Banjar',
        'Permohonan Perbaikan Drainase',
        'Permohonan Pos Kamling',
        'Permohonan Sumur Bor Umum',
        'Permohonan Perbaikan Lapangan Olahraga',
        'Permohonan Alat Kebersihan Lingkungan',
        'Permohonan Pengecatan Fasilitas Umum',
        'Permohonan Tempat Sampah Terpadu',
        'Permohonan Modal Usaha',
        'Permohonan Pelatihan Wirausaha',
        'Permohonan Promosi Produk UMKM',
        'Permohonan Stand Pasar Rakyat',
        'Permohonan Sertifikasi Halal',
        'Permohonan Pembinaan UMKM',
        'Permohonan Bantuan Alat Produksi',
        'Permohonan Pelatihan Digital Marketing',
        'Permohonan Koperasi Desa',
        'Permohonan Subsidi Sewa Kios',
        'Permohonan Bantuan Sosial untuk Lansia',
        'Permohonan Bantuan Pendidikan Anak Kurang Mampu',
        'Permohonan Bedah Rumah Tidak Layak Huni',
        'Permohonan Bantuan Korban Bencana',
        'Permohonan Alat Bantu untuk Difabel',
        'Permohonan Makanan Tambahan Balita',
        'Permohonan Beasiswa Pelajar Berprestasi',
        'Permohonan Sosialisasi Bahaya Narkoba',
        'Permohonan Pemberdayaan Perempuan Desa',
        'Permohonan Kegiatan Pemuda Desa',
        'Permohonan Penanaman Pohon',
        'Permohonan Pembentukan Bank Sampah',
        'Permohonan Fasilitasi Upacara Adat',
        'Permohonan Kegiatan Pelestarian Budaya',
        'Permohonan Festival Seni dan Budaya Desa',
        'Permohonan Pelatihan Pengelolaan Sampah Organik',
        'Permohonan Program Edukasi Lingkungan',
        'Permohonan Penetapan Kawasan Hijau Desa',
        'Permohonan Penataan Ruang Terbuka Hijau',
        'Permohonan Alat Musik Tradisional',
    ];

    public $dummyPengajuans = [
        'Dengan ini saya mengajukan permohonan pembuatan KTP baru karena saya merupakan warga pendatang yang telah menetap secara tetap di Desa Ungasan. Bersama ini saya lampirkan fotokopi KK dan surat domisili. Saya berharap pihak desa dapat memfasilitasi proses perekaman KTP saya.',
        'Saya mengajukan perbaikan data dalam Kartu Keluarga milik saya, karena terdapat kesalahan penulisan nama anak saya. Mohon dibantu untuk proses koreksi data melalui Dinas Kependudukan.',
        'Saya memohon surat keterangan domisili karena diperlukan sebagai syarat pendaftaran sekolah anak saya di wilayah Kecamatan Kuta Selatan. Saat ini saya tinggal.',
        'Saya memohon SKTM untuk keperluan pendaftaran beasiswa pendidikan bagi anak saya, karena kondisi ekonomi keluarga yang tidak mampu. Bersama ini saya lampirkan fotokopi KK dan surat keterangan penghasilan.',
        'Saya bermaksud pindah domisili ke wilayah Desa Ungasan, dan membutuhkan surat keterangan pindah dari Desa Ungasan sebagai syarat mutasi data kependudukan.',
        'Saya ingin mengurus akta kelahiran anak saya yang lahir, namun belum tercatat secara resmi. Mohon bantuannya dalam pengurusan dokumen tersebut.',
        'Dengan ini saya memohon bantuan pengurusan akta kematian untuk almarhum/almarhumah ayah yang meninggal, untuk keperluan pengurusan dokumen warisan.',
        'Saya memohon dibuatkan surat nikah adat sebagai bukti bahwa saya dan pasangan telah menikah secara adat Bali.',
        'Saya memohon surat keterangan belum menikah sebagai persyaratan administrasi lamaran pekerjaan . Saya belum pernah menikah secara adat maupun hukum.',
        'Saya mohon surat pengantar SKCK dari desa untuk keperluan melamar pekerjaan. Bersama ini saya lampirkan fotokopi KTP dan KK.',
        'Saya selaku warga Desa Ungasan mengajukan permohonan perbaikan jalan lingkungan di wilayah kami karena rusak parah dan membahayakan warga, terutama saat musim hujan.',
        'Kami mengajukan permohonan pemasangan lampu jalan di sekitar desa ungasan karena area tersebut gelap dan rawan tindak kejahatan pada malam hari.',
        'Kami dari krama Desa Ungasan memohon bantuan pembangunan Balai Banjar karena bangunan lama sudah tidak layak pakai untuk kegiatan sosial dan adat.',
        'Saya mengajukan perbaikan saluran drainase di sekitar desa ungasan karena kerap terjadi banjir saat hujan, menyebabkan genangan dan bau tidak sedap.',
        'Bersama warga lingkungan di sekitar desa ungasan, kami mengajukan permohonan pembangunan pos kamling untuk mendukung sistem keamanan lingkungan melalui ronda malam.',
        'Kami memohon bantuan pembuatan sumur bor karena kesulitan akses air bersih, terutama pada musim kemarau di wilayah kami.',
        'Kami dari kelompok pemuda Desa Ungasan memohon perbaikan lapangan sepak bola desa agar dapat digunakan kembali untuk latihan dan turnamen antarbanjar.',
        'Kami mengajukan permohonan bantuan alat kebersihan seperti cangkul, sapu, dan tong sampah untuk kegiatan gotong royong rutin di lingkungan kami.',
        'Kami memohon pengecatan ulang fasilitas umum seperti balai banjar dan gapura karena kondisinya kusam dan tidak representatif.',
        'Permohonan ini kami ajukan agar desa menyediakan tempat sampah organik dan anorganik di beberapa titik strategis sebagai upaya mengelola sampah dengan baik.',
        'Saya pelaku usaha kecil bidang kerajinan tangan memohon bantuan modal usaha untuk meningkatkan kapasitas produksi dan menjangkau pasar yang lebih luas.',
        'Kami dari kelompok ibu rumah tangga memohon diadakannya pelatihan wirausaha agar kami memiliki keterampilan dan bisa mandiri secara ekonomi.',
        'Saya mengajukan permohonan promosi bagi produk olahan makanan milik saya agar dapat dikenal masyarakat luas melalui media sosial desa atau bazar lokal.',
        'Saya memohon disediakan stand di pasar rakyat desa agar dapat menjual hasil pertanian dan kerajinan lokal secara rutin.',
        'Saya pengusaha makanan rumahan memohon bantuan proses sertifikasi halal agar produk saya dapat masuk ke toko modern dan memenuhi regulasi.',
        'Permohonan ini saya ajukan agar usaha kecil kami mendapatkan pembinaan secara rutin tentang manajemen usaha, pembukuan, dan strategi pemasaran.',
        'Saya memohon bantuan alat produksi berupa mesin pengemas makanan ringan untuk meningkatkan efisiensi dan kualitas produk saya.',
        'Saya pelaku UMKM bidang fashion memohon diadakan pelatihan digital marketing agar mampu memasarkan produk melalui e-commerce.',
        'Saya mengusulkan pembentukan koperasi desa yang dapat menaungi usaha warga dalam bentuk simpan pinjam dan distribusi kebutuhan pokok.',
        'Saya memohon subsidi sewa kios di pasar desa karena keterbatasan modal untuk menutupi biaya sewa secara penuh setiap bulan.',
        'Saya mengajukan permohonan bantuan sosial bagi orang tua saya yang telah lanjut usia dan tidak memiliki penghasilan tetap, dengan harapan dapat meringankan biaya kebutuhan pokok sehari-hari.',
        'Saya mohon bantuan biaya pendidikan untuk anak saya yang saat ini duduk di bangku SMA, karena keterbatasan ekonomi membuat kami kesulitan membayar uang sekolah dan perlengkapan belajar.',
        'Saya memohon agar rumah saya dapat menerima bantuan program bedah rumah, mengingat kondisi bangunan yang rapuh, atap bocor, dan tidak aman untuk dihuni bersama keluarga.',
        'Saya mengajukan permohonan bantuan darurat karena rumah saya terdampak banjir/kebakaran/angin kencang yang menyebabkan kerusakan dan kehilangan harta benda.',
        'Saya memohon bantuan alat bantu seperti kursi roda atau tongkat jalan untuk anak saya yang merupakan penyandang disabilitas dan belum mendapatkan fasilitas yang memadai.',
        'Saya memohon agar anak saya yang berusia 2 tahun dapat menerima program makanan tambahan balita dari desa karena mengalami gejala kekurangan gizi dan berat badan rendah.',
        'Saya mengajukan permohonan beasiswa untuk anak saya yang mendapatkan peringkat 1 di sekolahnya sebagai bentuk penghargaan dan dukungan pendidikan dari desa.',
        'Kami memohon diadakannya kegiatan sosialisasi bahaya narkoba untuk kalangan remaja dan pemuda desa guna meningkatkan kesadaran serta pencegahan penyalahgunaan zat adiktif.',
        'Kami dari kelompok ibu-ibu Desa Ungasan memohon pelatihan menjahit/memasak/kerajinan agar perempuan desa dapat lebih produktif dan memiliki penghasilan tambahan.',
        'Kami dari karang taruna Desa Ungasan mengajukan kegiatan pembinaan dan pengembangan kreativitas pemuda seperti pelatihan digital, olahraga, atau lomba desa.',
        'Kami mengajukan kegiatan penanaman pohon di wilayah perumahan kami sebagai bentuk kepedulian terhadap lingkungan dan upaya menciptakan udara yang lebih segar dan sehat.',
        'Saya mengusulkan pembentukan bank sampah di desa untuk mengedukasi masyarakat dalam memilah dan menabung sampah serta sebagai upaya pemberdayaan ekonomi berbasis lingkungan.',
        'Kami memohon dukungan fasilitas untuk pelaksanaan upacara adat didesa Ungasan agar kegiatan tradisional tetap berjalan dengan lancar dan lestari.',
        'Kami mengajukan kegiatan pelestarian budaya seperti pelatihan menari, belajar gamelan, dan pengenalan aksara Bali kepada anak-anak dan remaja sebagai warisan budaya lokal.',
        'Kami memohon diselenggarakannya festival seni dan budaya sebagai ajang kreatifitas warga serta sarana promosi pariwisata dan budaya Desa Ungasan.',
        'Kami mengusulkan pelatihan pengolahan sampah organik menjadi kompos agar warga bisa mengelola sampah rumah tangga sendiri secara ramah lingkungan.',
        'Kami memohon diadakan edukasi tentang pentingnya menjaga lingkungan, mulai dari pengelolaan sampah, daur ulang, hingga penggunaan air bersih secara efisien.',
        'Kami mengusulkan agar lahan kosong di sekitar Banjar kami dijadikan kawasan hijau desa untuk kegiatan taman, olahraga, atau ruang terbuka publik yang bersifat ekologis.',
        'Saya mengajukan permohonan penataan ulang taman desa agar lebih tertata, bersih, dan bisa difungsikan sebagai area bermain anak atau tempat rekreasi keluarga.',
        'Kami memohon bantuan pengadaan alat musik tradisional Bali seperti gong dan rindik untuk menunjang kegiatan budaya dan latihan seni anak-anak di banjar kami.',
    ];

    /**
     * Create a new class instance.
     */
    public function __construct($jumlah)
    {
        $this->jumlah = $jumlah;
    }

    public function generate()
    {
        $randomIDs = DB::connection('ungasan')->table('users')->where('user_type', 'penduduk')->whereNotNull('email')->whereNotNull('email_verified_at')->whereNull('deleted_at')->orderByRaw('RAND()')->limit($this->jumlah)->get()->pluck('sid');
        $randomPenduduks = DB::connection('ungasan')->table('penduduks')->orderByRaw('RAND()')->whereNull('deleted_at')->limit($this->jumlah)->get()->pluck('sid');
        $randomPekerjaans = DB::connection('ungasan')->table('jobs')->orderByRaw('RAND()')->whereNull('deleted_at')->get()->pluck('job_name');
        $datas = [];
        $klass = [];

        foreach (KlasifikasiLaporan::cases() as $k) {
            $klass[] = $k->name;
        }

        for ($i = 0; $i < $this->jumlah; $i++) {
            $user = Pengguna::find($randomIDs[$i]);
            $penduduk = Penduduk::find($randomPenduduks[$i]);

            $randNumber = rand(0, (count($this->dummyTitles)) - 1);
            $randDay = rand(1, 28);
            $randMonth = rand(1, 12);
            $randYear = rand(2023, 2025);
            $ranH = rand(00, 23);
            $randM = rand(00, 59);

            $genDate = $randYear . '-' . $randMonth . '-' . $randDay . ' ' . $ranH . ':' . $randM;

            $status = [
                'aktif',
                'selesai',
                'kurang_info',
                'pending',
                'diproses'
            ];

            $datas = [
                // laporan
                "uuid" => Str::uuid(),
                "judul" => $this->dummyTitles[$randNumber],
                "isi" => $this->dummyPengajuans[$randNumber],
                "tanggal_kejadian" => Carbon::createFromDate($randYear, $randMonth, $randDay),
                "lokasi_kejadian" => $penduduk->alamat,
                "banjar_kejadian" => $penduduk->dusun,
                "anonim" => rand(0, 1),
                "rahasia" => rand(0, 1),
                "klasifikasi" => $klass[rand(0, (count($klass) - 1))],

                // pelapor
                "nik" => $penduduk->nik,
                "nama" => $penduduk->nama_lengkap,
                "alamat" => $penduduk->alamat,
                "tanggal_lahir" => $penduduk->tanggal_lahir,
                "pekerjaan" => $randomPekerjaans[$randNumber],
                "no_telpon" => $user->no_wa,
                "status" => $status[rand(0, (count($status) - 1))],
                "created_at" => $genDate,
                "updated_at" => $genDate,
            ];

            LaporanMasyarakat::create($datas);
        }

        Notification::make()
            ->title('Generasi Dummy Data Telah berhasil')
            ->success()
            ->send();
    }
}
