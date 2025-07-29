<x-layouts.base>
    <section id="content" class="flex flex-row justify-center">
        <div class="form-container w-4xl shadow-md -mt-50 z-10 bg-white p-10">
            @livewire('create-laporan')
        </div>
    </section>

    <section id="progress" class="flex flex-row justify-center">
        <div class="progress-grp relative p-20">
            <div class="cont grid lg:grid-cols-5 gap-5 relative">
                <div class="fitur w-50 flex flex-col items-center">
                    <div
                        class="logo flex flex-row justify-center items-center w-20 h-20 bg-red-700 text-white rounded-full">
                        <x-tabler-edit />
                    </div>
                    <div class="desc mt-2">
                        <h5 class="text-center font-bold">Tautan Dilaporkan</h5>
                        <p class="text-center">Laporkan keluhan atau aspirasi anda dengan jelas dan lengkap</p>
                    </div>
                </div>
                <div class="fitur w-50 flex flex-col items-center">
                    <div class="logo flex flex-row justify-center items-center w-20 h-20 shadow-md rounded-full">
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
                    <a href="/tentang" wire:navigate
                        class="border-2 rounded px-5 py-3 font-bold border-red-700 text-red-700 hover:bg-red-700 hover:text-white">PELAJARI
                        LEBIH LANJUT</a>
                </div>
            </div>
        </div>
    </section>

    <section id="jumlah" class="flex flex-row justify-center">
        <div class="w-full py-20 text-center bg-red-700 text-white">
            <h5 class="font-bold text-3xl">Jumlah Yang Terdaftar Pada Sistem</h5>
            <h1 class="font-bold text-5xl mt-5">{{ $laporans['total'] }} Laporan</h1>

            <div class="btn lg:col-span-5 flex flex-row justify-center items-center mt-10">
                <a href="/publik" wire:navigate
                    class="border-2 rounded px-5 py-3 font-bold border-white text-white hover:bg-white hover:text-red-300">LIHAT
                    SEMUA LAPORAN</a>
            </div>
        </div>
    </section>

    <section id="progress" class="flex flex-row justify-center">
        <div class="progress-grp relative p-20">
            <div class="cont grid lg:grid-cols-4 gap-5 relative">

                <div class="btn lg:col-span-4 flex flex-row justify-center items-center mb-5">
                    <h5 class="text-2xl text-center font-bold text-gray-400 text-shadow-2xs">JUMLAH PER KLASIFIKASI</h5>
                </div>

                @foreach ($laporans['klass'] as $item)
                    @php
                        $name = '';

                        if ($item['name'] != 'POSYANKUMHAMDES') {
                            $name = str_replace('_', ' ', strtolower($item['name']));
                        } else {
                            $name = $item['name'];
                        }
                    @endphp

                    <div class="fitur lg:w-50 flex flex-col items-center">
                        <div class="desc mt-2">
                            <h5 class="text-center text-5xl font-bold mb-5">{{ $item['total'] }}</h5>
                            <p class="text-center text-lg text-gray-400 capitalize">{{ $name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.base>
