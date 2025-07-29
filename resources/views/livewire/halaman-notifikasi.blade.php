<x-layouts.base>
    <section id="content" class="flex flex-row justify-center">
        <div class="form-container w-4xl shadow-md -mt-50 z-10 bg-white p-10">

            <h5 class="mb-10 text-center text-2xl font-bold">Selamat Laporan anda telah berhasil di laporkan.</h5>

            <p>
                <strong>Pemberitahuan:</strong><br>

                Laporan Anda telah berhasil disimpan ke dalam sistem kami. Proses verifikasi akan dilakukan dalam waktu
                3–5 hari kerja. Apabila laporan ini memerlukan tindak lanjut atau telah selesai diverifikasi, kami akan
                mengirimkan pemberitahuan melalui pesan WhatsApp ke nomor yang Anda cantumkan saat pengajuan laporan.

                <br>
                <br>

                Terima kasih atas kepercayaan Anda dalam menggunakan layanan pelaporan ini. <br>
                Jika Anda membutuhkan bantuan lebih lanjut, silakan hubungi petugas.
            </p>
        </div>
    </section>

    <section id="progress" class="flex flex-row justify-center">
        <div class="progress-grp relative p-20">
            <div class="cont grid lg:grid-cols-5 gap-5 relative">
                <div class="fitur w-50 flex flex-col items-center">
                    <div class="logo flex flex-row justify-center items-center w-20 h-20  shadow-md rounded-full">
                        <x-tabler-edit />
                    </div>
                    <div class="desc mt-2">
                        <h5 class="text-center font-bold">Tautan Dilaporkan</h5>
                        <p class="text-center">Laporkan keluhan atau aspirasi anda dengan jelas dan lengkap</p>
                    </div>
                </div>
                <div class="fitur w-50 flex flex-col items-center">
                    <div
                        class="logo flex flex-row justify-center items-center w-20 h-20 bg-red-700 text-white shadow-md rounded-full">
                        <x-tabler-checklist />
                    </div>
                    <div class="desc mt-2">
                        <h5 class="text-center font-bold">Proses Verifikasi</h5>
                        <p class="text-center">Dalam 3 hari, laporan Anda akan diverifikasi dan diteruskan kepada
                            instansi berwenang</p>
                    </div>
                </div>
                <div class="fitur w-50 flex flex-col items-center">
                    <div class="logo flex flex-row justify-center items-center w-20 h-20 shadow-md rounded-full">
                        <x-tabler-trekking />
                    </div>
                    <div class="desc mt-2">
                        <h5 class="text-center font-bold">Proses Tindak Lanjut</h5>
                        <p class="text-center">Dalam 5 hari, instansi akan menindaklanjuti dan membalas laporan Anda</p>
                    </div>
                </div>
                <div class="fitur w-50 flex flex-col items-center">
                    <div class="logo flex flex-row justify-center items-center w-20 h-20 shadow-md rounded-full">
                        <x-tabler-bubble-text />
                    </div>
                    <div class="desc mt-2">
                        <h5 class="text-center font-bold">Beri Tanggapan</h5>
                        <p class="text-center">Anda dapat menanggapi kembali balasan yang diberikan oleh instansi dalam
                            waktu 10 hari</p>
                    </div>
                </div>
                <div class="fitur w-50 flex flex-col items-center">
                    <div class="logo flex flex-row justify-center items-center w-20 h-20 shadow-md rounded-full">
                        <x-tabler-checks />
                    </div>
                    <div class="desc mt-2">
                        <h5 class="text-center font-bold">Selesai</h5>
                        <p class="text-center">Laporan Anda akan terus ditindaklanjuti hingga terselesaikan</p>
                    </div>
                </div>

                <div class="btn lg:col-span-5 flex flex-row justify-center items-center mt-5">
                    <a href="#"
                        class="border-2 rounded px-5 py-3 font-bold border-red-700 text-red-700 hover:bg-red-700 hover:text-white">PELAJARI
                        LEBIH LANJUT</a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.base>
