<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sekolah | GiziTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col bg-gray-50 font-sans">
    <x-header />

    <div class="mt-16 flex flex-1">
        <x-layout />

        <div class="flex w-full flex-col items-center py-10">
            <h1 class="mb-8 ml-[10%] self-start text-4xl font-bold text-slate-900">Tambah Sekolah</h1>

            <form action="{{ route('storeSekolah') }}" method="POST" enctype="multipart/form-data" id="addSchoolForm"
                class="grid w-full max-w-4xl grid-cols-[180px_1fr] gap-8 px-4">
                @csrf

                <div class="flex flex-col gap-4">
                    <div
                        class="flex h-[180px] w-[180px] items-center justify-center overflow-hidden rounded-xl border-2 border-dashed border-gray-300 bg-white shadow-sm transition-colors hover:border-blue-400">
                        <img id="previewLogo" src="{{ asset('uploads/logo/default.jpg') }}" alt="Logo Sekolah"
                            class="h-full w-full object-contain p-2">
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="logoInput"
                            class="cursor-pointer rounded-lg bg-blue-50 px-4 py-2 text-center text-sm font-bold text-blue-600 transition-colors hover:bg-blue-100">
                            Upload Logo
                        </label>
                        <input type="file" name="logo" id="logoInput" accept="image/*" class="hidden">
                        <small class="text-center text-xs text-gray-500">*Format: JPG, PNG, WEBP (maks 2MB)</small>
                    </div>
                </div>

                <div class="flex flex-col gap-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold text-gray-600">Nama Sekolah</label>
                            <input
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                name="name" placeholder="Masukkan nama sekolah" required>
                        </div>

                        <div class="col-span-2 flex flex-col gap-2">
                            <label class="text-sm font-bold text-gray-600">Alamat Sekolah</label>
                            <input
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                name="location" placeholder="Masukkan alamat sekolah" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold text-gray-600">Jumlah Siswa</label>
                            <input
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                name="total_student" type="number" min="1" placeholder="Contoh: 300" required>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold text-gray-600">Jumlah Porsi</label>
                            <input
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                name="total_meal" type="number" min="1" placeholder="Contoh: 300" required>
                        </div>

                        <div class="col-span-2 flex flex-col gap-2">
                            <label class="text-sm font-bold text-gray-600">Alergi</label>
                            <input
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                name="type_allergy" placeholder="Contoh: Susu, Kacang, Telur">
                        </div>
                    </div>

                    <button type="submit"
                        class="mt-4 w-full rounded-lg bg-yellow-500 py-3 text-base font-bold text-black transition-colors hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        Simpan Sekolah
                    </button>
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
                if (!file.type.startsWith('image/')) {
                    alert('File harus berupa gambar!');
                    fileInput.value = '';
                    return;
                }
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran gambar maksimal 2MB!');
                    fileInput.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = () => previewLogo.src = reader.result;
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>