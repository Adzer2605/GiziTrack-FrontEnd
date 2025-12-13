<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sekolah | GiziTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
</head>

<body class="flex min-h-screen flex-col bg-gray-50 font-sans">
    <x-header />

    <div class="mt-16 flex flex-1">
        <x-layout />
        <div class="flex w-full flex-col items-center py-10">
            <div class="mb-8 w-4/5 flex justify-between items-center">
                <h1 class="text-3xl font-bold text-slate-900">Detail Sekolah</h1>
                <a href="/sekolah" class="text-sm font-bold text-gray-500 hover:text-blue-600 flex items-center gap-2">
                    Kembali
                </a>
            </div>

            <form id="schoolForm" enctype="multipart/form-data" class="w-4/5 grid grid-cols-1 lg:grid-cols-3 gap-8">
                @csrf
                <div
                    class="lg:col-span-1 h-fit flex flex-col items-center rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div
                        class="mb-6 h-48 w-48 overflow-hidden rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 p-2 flex items-center justify-center">
                        <img id="schoolLogo" src="" alt="Logo Sekolah" class="h-full w-full object-contain">
                    </div>

                    <div class="w-full">
                        <label class="mb-2 block text-sm font-bold text-gray-700 text-center">Update Logo</label>
                        <input type="file" name="logo" id="logoInput" accept="image/*" disabled
                            class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-yellow-50 file:px-4 file:py-2 file:text-sm file:font-bold file:text-yellow-700 hover:file:bg-yellow-100 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer">
                        <p class="mt-2 text-xs text-gray-400 text-center">Format: JPG, PNG (Max 2MB)</p>
                    </div>
                </div>

                <div class="lg:col-span-2 flex flex-col rounded-xl border border-gray-200 bg-white p-8 shadow-sm">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold text-gray-600">Nama Sekolah</label>
                            <input
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 disabled:bg-gray-50 disabled:text-gray-600 disabled:border-gray-200 transition-colors"
                                id="name" name="name" value="" disabled>
                        </div>
                        <div class="flex flex-col gap-2 md:col-span-2">
                            <label class="text-sm font-bold text-gray-600">Alamat Lengkap</label>
                            <input
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 disabled:bg-gray-50 disabled:text-gray-600 disabled:border-gray-200 transition-colors"
                                id="location" name="location" value="" disabled>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold text-gray-600">Jumlah Siswa</label>
                            <input type="number"
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 disabled:bg-gray-50 disabled:text-gray-600 disabled:border-gray-200 transition-colors"
                                id="total_student" name="total_student" value="" disabled>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold text-gray-600">Jumlah Porsi</label>
                            <input type="number"
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 disabled:bg-gray-50 disabled:text-gray-600 disabled:border-gray-200 transition-colors"
                                id="total_meal" name="total_meal" value="" disabled>
                        </div>
                        <div class="flex flex-col gap-2 md:col-span-2">
                            <label class="text-sm font-bold text-gray-600">Daftar Alergi (Opsional)</label>
                            <input
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 disabled:bg-gray-50 disabled:text-gray-600 disabled:border-gray-200 transition-colors"
                                id="type_allergy" name="type_allergy" value="" disabled>
                        </div>
                    </div>

                    <div class="mt-8 flex gap-4 border-t border-gray-100 pt-6">
                        <button type="button"
                            class="rounded-lg bg-yellow-500 px-8 py-3 font-bold text-slate-900 transition-all hover:bg-yellow-400 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-400"
                            id="editBtn">
                            Edit Data
                        </button>
                        <button type="button"
                            class="rounded-lg bg-red-50 px-8 py-3 font-bold text-red-600 transition-all hover:bg-red-100 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-200"
                            id="deleteBtn">
                            Hapus Sekolah
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const schoolId = window.location.pathname.split('/').pop();
        document.addEventListener("DOMContentLoaded", function () {
            fetch(`{{ config('app.backend_url') }}/api/school/` + schoolId, { credentials: 'include' })
                .then(res => res.json())
                .then(result => {
                    const data = result.data;

                    document.getElementById('schoolLogo').src = data.logo.startsWith('http') ? data.logo : `{{ config('app.backend_url') }}/${data.logo.replace(/^\//, '')}`;
                    document.getElementById('name').value = data.name;
                    document.getElementById('location').value = data.location;
                    document.getElementById('total_student').value = data.total_student;
                    document.getElementById('total_meal').value = data.total_meal;
                    document.getElementById('type_allergy').value = data.type_allergy || '-'; // Handle null
                })
                .catch(err => console.error("Error loading data:", err));
        });

        const editBtn = document.getElementById('editBtn');
        const deleteBtn = document.getElementById('deleteBtn');
        const inputs = document.querySelectorAll('#schoolForm input:not([type=file])');
        const fileInput = document.getElementById('logoInput');
        const logoPreview = document.getElementById('schoolLogo');
        const form = document.getElementById('schoolForm');

        fileInput.addEventListener('change', e => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => logoPreview.src = reader.result;
                reader.readAsDataURL(file);
            }
        });

        editBtn.addEventListener('click', async () => {
            if (editBtn.textContent.trim() === 'Edit Data') {
                inputs.forEach(i => {
                    i.removeAttribute('disabled');
                    i.classList.remove('bg-gray-50');
                });
                fileInput.removeAttribute('disabled');
                editBtn.textContent = 'Simpan Perubahan';
                editBtn.classList.remove('bg-yellow-500', 'hover:bg-yellow-400', 'text-slate-900');
                editBtn.classList.add('bg-green-600', 'hover:bg-green-700', 'text-white', 'shadow-lg');
            } else {
                const formData = new FormData(form);

                try {
                    formData.append('_method', 'PUT');

                    const response = await fetch(`{{ config('app.backend_url') }}/api/school/` + schoolId, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                        },
                        credentials: 'include',
                        body: formData
                    });

                    if (response.ok) {
                        alert('Data berhasil diperbarui!');

                        inputs.forEach(i => {
                            i.setAttribute('disabled', true);
                            i.classList.add('bg-gray-50');
                        });
                        fileInput.setAttribute('disabled', true);

                        editBtn.textContent = 'Edit Data';
                        editBtn.classList.add('bg-yellow-500', 'hover:bg-yellow-400', 'text-slate-900');
                        editBtn.classList.remove('bg-green-600', 'hover:bg-green-700', 'text-white', 'shadow-lg');
                    } else {
                        alert('Gagal menyimpan data. Cek inputan kembali.');
                    }
                } catch (e) {
                    alert('Terjadi kesalahan jaringan: ' + e.message);
                }
            }
        });

        deleteBtn.addEventListener('click', async () => {
            if (confirm('Yakin ingin menghapus sekolah ini secara permanen?')) {
                try {
                    const response = await fetch(`{{ config('app.backend_url') }}/api/school/${schoolId}`, {
                        method: 'DELETE',
                        credentials: 'include'
                    });

                    if (response.ok) {
                        alert('Sekolah berhasil dihapus.');
                        window.location.href = '/sekolah';
                    } else {
                        alert('Gagal menghapus data.');
                    }
                } catch (e) {
                    alert('Error: ' + e.message);
                }
            }
        });
    </script>
</body>

</html>