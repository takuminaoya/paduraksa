<x-layouts.base>
    <style>
        .fi-in-entry-label {
            font-weight: bold;
        }
    </style>

    <section id="content" class="flex flex-row justify-center">
        <div class="form-container w-7xl shadow-md -mt-50 z-10 bg-white p-10">

            <h5 class="text-center text-2xl font-bold">Daftar Laporan Pengaduan Aspirasi Masyarakat Desa Ungasan.
            </h5>
            <h5 class="mb-10 text-center">Ini adalah Daftar Laporan yang telah diperbolehkan atau
                tidak dirahasiakan oleh pelapor.</h5>

            {{ $this->table }}
        </div>
    </section>
</x-layouts.base>
