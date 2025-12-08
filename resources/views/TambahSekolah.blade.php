<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sekolah | GiziTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
</head>

<body class="flex min-h-screen flex-col bg-gray-50 font-sans">
    <x-header />

    <div class="mt-16 flex flex-1">
        <x-layout />

        <div class="flex w-full flex-col items-center py-10">
            
            <!-- Header Section (Sama seperti Detail Sekolah) -->
            <div class="mb-8 flex w-4/5 items-center justify-between">
                <h1 class="text-3xl font-bold text-slate-900">Tambah Sekolah Baru</h1>
                
                <a href="/sekolah" class="flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Form Layout Grid (Sama seperti Detail Sekolah) -->
            <form action="{{ route('storeSekolah') }}" method="POST" enctype="multipart/form-data" id="addSchoolForm"
                class="grid w-4/5 grid-cols-1 gap-8 lg:grid-cols-3">
                @csrf

                <!-- KOLOM KIRI: UPLOAD LOGO -->
                <div class="flex h-fit flex-col items-center rounded-xl border border-gray-200 bg-white p-6 shadow-sm lg:col-span-1">
                    <div class="mb-6 flex h-48 w-48 items-center justify-center overflow-hidden rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 p-2">
                        <!-- Default Image Placeholder -->
                        <img id="previewLogo" src="{{ asset('uploads/logo/default.jpg') }}" 
                             onerror="this.src='https://placehold.co/200x200?text=No+Logo'" 
                             alt="Preview Logo" class="h-full w-full object-contain">
                    </div>

                    <div class="w-full">
                        <label for="logoInput" class="mb-2 block text-center text-sm font-bold text-gray-700">Upload Logo Sekolah</label>
                        <input type="file" name="logo" id="logoInput" accept="image/*"
                            class="block w-full cursor-pointer text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-bold file:text-blue-700 hover:file:bg-blue-100">
                        <p class="mt-2 text-center text-xs text-gray-400">*Format: JPG, PNG (Maks 2MB)</p>
                    </div>
                </div>

                <!-- KOLOM KANAN: FORM DATA -->
                <div class="flex flex-col rounded-xl border border-gray-200 bg-white p-8 shadow-sm lg:col-span-2">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        
                        <!-- Nama Sekolah -->
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold text-gray-600">Nama Sekolah <span class="text-red-500">*</span></label>
                            <input
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                name="name" placeholder="Masukkan nama sekolah" required>
                        </div>

                        <!-- Alamat -->
                        <div class="flex flex-col gap-2 md:col-span-2">
                            <label class="text-sm font-bold text-gray-600">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <input
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                name="location" placeholder="Masukkan alamat sekolah" required>
                        </div>

                        <!-- Jumlah Siswa -->
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold text-gray-600">Jumlah Siswa <span class="text-red-500">*</span></label>
                            <input
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                name="total_student" type="number" min="1" placeholder="0" required>
                        </div>

                        <!-- Jumlah Porsi -->
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold text-gray-600">Jumlah Porsi <span class="text-red-500">*</span></label>
                            <input
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                name="total_meal" type="number" min="1" placeholder="0" required>
                        </div>

                        <!-- Alergi -->
                        <div class="flex flex-col gap-2 md:col-span-2">
                            <label class="text-sm font-bold text-gray-600">Alergi Mayoritas (Opsional)</label>
                            <input
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                name="type_allergy" placeholder="Contoh: Susu, Kacang, Telur">
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="mt-8 border-t border-gray-100 pt-6">
                        <button type="submit"
                            class="w-full rounded-lg bg-yellow-500 py-3.5 text-base font-bold text-slate-900 transition-all hover:bg-yellow-400 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-1">
                            Simpan Data Sekolah
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Preview logo sebelum di-upload
        const fileInput = document.getElementById('logoInput');
        const previewLogo = document.getElementById('previewLogo');

        fileInput.addEventListener('change', e => {
            const file = e.target.files[0];
            if (file) {
                // Validasi Tipe File
                if (!file.type.startsWith('image/')) {
                    alert('File harus berupa gambar (JPG, PNG, dll)!');
                    fileInput.value = '';
                    previewLogo.src = "{{ asset('uploads/logo/default.jpg') }}"; // Reset ke default
                    return;
                }
                
                // Validasi Ukuran (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran gambar maksimal 2MB!');
                    fileInput.value = '';
                    return;
                }

                // Tampilkan Preview
                const reader = new FileReader();
                reader.onload = () => previewLogo.src = reader.result;
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>