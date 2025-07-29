<x-layouts.base>
    <section id="content" class="flex flex-row justify-center">
        <div class="form-container w-4xl shadow-md -mt-50 z-10 bg-white p-10">

            <h5 class="mb-10 text-center text-2xl font-bold">Petunjuk Penggunaan Sistem Pengaduan Aspirasi Masyarakat Desa Ungasan.</h5>

            <p>
                <strong>Penjelasan Awal:</strong><br>

                Selamat Datang di sistem paduraksa dimana segala laporan yang menuju ke desa ungsan akan di tampung dan diproses disini. untuk melakukan laporan anda dapat pergi ke halaman awal atau <a href="/" target="_blank" class="text-red-700 hover:underline">Disini</a>. Thapan pelaporan dibagi menjadi dua yaitu pengisian detail laporan dan detail pelapor. dimana detail laporan adalah data-data yang inin dilaporkan dan detail pelapor adalah detail data diri anda. untuk menjadi penanggung jawab nantinya. adapun penjelasan secara terperinci. 
            </p>

            <h5 class="mt-5"><strong>Detail Laporan (<span class="text-red-700">*</span> berarti harus diisi.)</strong></h5>
            <ol class="b list-decimal">
                <li class="ml-10">Judul* : Judul/Nama Laporan</li>
                <li class="ml-10">Isi* : Deskripsi kejadian bisan diisikan gambar atau bisa di upload via lampiran dibawah</li>
                <li class="ml-10">Tanggal Kejadian* : Tanggal Kapan kejadian tersebut terjadi</li>
                <li class="ml-10">Lokasi* : Tempat/Alamat/Jalan dimana kejadian tersebut terjadi.</li>
                <li class="ml-10">Banjar* : Banjar dimana kejadian tersebut terjadi</li>
                <li class="ml-10">Klasifikasi* : Jenis Laporan</li>
                <li class="ml-10">Anonim : Nama anda tidak akan muncul pada publik.</li>
                <li class="ml-10">Rahasia : Laporan anda hanya bisa dilihat oleh pegawai instansi atau tidak dapat dilihat oleh publik.</li>
                <li class="ml-10">Lampiran : Gambar atau file pendukung.</li>
            </ol>

            <img class="w-full mt-5" src="{{ asset('storage/images/step1.png') }}" alt="">

            <p class="mt-5">
                Setelah diisi semua yang memang harus diisi anda bisa menekan tombol next untuk melanjutkan. jika anda menekan tombol laporkan tidak akan terjadi apapun dikarenakan data belum lengkap.
            </p>

            <h5 class="mt-5"><strong>Detail Pelapor (<span class="text-red-700">*</span> berarti harus diisi.)</strong></h5>
            <p class="mt-5">
                Disini seperti yang dijelaskan diatas. anda cukup mengisikan data diri anda. agar kami atau pegawai desa dapat menverifikasi apakah laporan tersebut valid.
            </p>

            <img class="w-full mt-5" src="{{ asset('storage/images/step2.png') }}" alt="">

            <p class="mt-5">
                Jika merasa pada form laporan anda terdapat data yang kurang/salah atau sebagainya. dapat menekan tombol back untuk kembali mengeditnya. Jika telah selesai anda dapat menekan tombol laporkan. jika berhasil akan muncul halaman sebagai berikut.
            </p>

            <img class="w-full mt-5" src="{{ asset('storage/images/final.png') }}" alt="">

            <p class="mt-5 mb-10">
                Sekian Penjelasan dari Kami Dan Terima Kasih Telah menggunakan sistem ini.
            </p>

            <small class="text-xs italic">Terakhir Diupdate pada {{ date('D, d F Y') }}</small>
        </div>
    </section>
</x-layouts.base>
