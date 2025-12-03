<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sekolah | GiziTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col bg-gray-50 font-sans">
    <x-header />
    <div class="mt-16 flex flex-1">
        <x-layout />

        <div class="flex w-full flex-col px-10 py-10">
            <h1 class="mb-8 text-3xl font-bold text-slate-900">Detail Sekolah</h1>

            <form class="grid w-full max-w-4xl grid-cols-[180px_1fr] gap-8" id="schoolForm"
                enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col items-center gap-4">
                    <div class="h-40 w-40 overflow-hidden rounded-2xl border-2 border-gray-200 bg-white p-2 shadow-sm">
                        <img id="schoolLogo" src="" alt="Logo Sekolah" class="h-full w-full object-contain">
                    </div>

                    <div class="w-full">
                        <label class="mb-2 block text-sm font-medium text-gray-600">Ganti Logo</label>
                        <input type="file" name="logo" id="logoInput" accept="image/*" disabled
                            class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100 disabled:opacity-50">
                    </div>
                </div>

                <div class="flex flex-col gap-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="flex flex-col rounded-lg border border-gray-300 bg-white p-4 shadow-sm">
                            <span class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-500">Nama
                                Sekolah</span>
                            <input
                                class="w-full border-none bg-transparent p-0 text-lg font-bold text-gray-900 focus:ring-0 disabled:text-gray-700"
                                id="name" name="name" value="" disabled>
                        </div>

                        <div class="col-span-2 flex flex-col rounded-lg border border-gray-300 bg-white p-4 shadow-sm">
                            <span class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-500">Alamat
                                Sekolah</span>
                            <input
                                class="w-full border-none bg-transparent p-0 text-lg font-bold text-gray-900 focus:ring-0 disabled:text-gray-700"
                                id="location" name="location" value="" disabled>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="flex flex-col rounded-lg border border-gray-300 bg-white p-4 shadow-sm">
                            <span class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-500">Jumlah
                                Siswa</span>
                            <input
                                class="w-full border-none bg-transparent p-0 text-lg font-bold text-gray-900 focus:ring-0 disabled:text-gray-700"
                                id="total_student" name="total_student" value="" disabled>
                        </div>
                        <div class="flex flex-col rounded-lg border border-gray-300 bg-white p-4 shadow-sm">
                            <span class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-500">Jumlah
                                Porsi</span>
                            <input
                                class="w-full border-none bg-transparent p-0 text-lg font-bold text-gray-900 focus:ring-0 disabled:text-gray-700"
                                id="total_meal" name="total_meal" value="" disabled>
                        </div>
                        <div class="col-span-2 flex flex-col rounded-lg border border-gray-300 bg-white p-4 shadow-sm">
                            <span class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-500">Alergi</span>
                            <input
                                class="w-full border-none bg-transparent p-0 text-lg font-bold text-gray-900 focus:ring-0 disabled:text-gray-700"
                                id="type_allergy" name="type_allergy" value="" disabled>
                        </div>
                    </div>

                    <div class="mt-4 flex gap-4">
                        <button type="button"
                            class="rounded-lg bg-yellow-500 px-6 py-2.5 font-bold text-black transition-colors hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                            id="editBtn">Edit Data</button>
                        <button type="button"
                            class="rounded-lg bg-red-600 px-6 py-2.5 font-bold text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                            id="deleteBtn">Hapus Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch(`/api/sekolah/{{ $id }}`)
                .then(res => res.json())
                .then(result => {
                    const data = result.data;

                    document.getElementById('schoolLogo').src = data.logo;
                    document.getElementById('name').value = data.name;
                    document.getElementById('location').value = data.location;
                    document.getElementById('total_student').value = data.total_student;
                    document.getElementById('total_meal').value = data.total_meal;
                    document.getElementById('type_allergy').value = data.type_allergy;
                })
                .catch(err => console.error(err));
        });

        const editBtn = document.getElementById('editBtn');
        const deleteBtn = document.getElementById('deleteBtn');
        const inputs = document.querySelectorAll('#schoolForm input:not([type=file])');
        const fileInput = document.getElementById('logoInput');
        const logoPreview = document.getElementById('schoolLogo');
        const form = document.getElementById('schoolForm');
        const schoolId = "{{$id}}";

        fileInput.addEventListener('change', e => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => logoPreview.src = reader.result;
                reader.readAsDataURL(file);
            }
        });

        // Tombol Edit / Simpan
        editBtn.addEventListener('click', async () => {
            if (editBtn.textContent === 'Edit Data') {
                inputs.forEach(i => i.removeAttribute('disabled'));
                fileInput.removeAttribute('disabled');
                editBtn.textContent = 'Simpan Data';
                editBtn.classList.add('bg-green-500', 'hover:bg-green-600', 'text-white');
                editBtn.classList.remove('bg-yellow-500', 'hover:bg-yellow-600', 'text-black');
            } else {
                const formData = new FormData(form);

                try {
                    const response = await fetch(`/sekolah/${schoolId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                        },
                        body: formData
                    });

                    if (response.ok) {
                        alert('Data berhasil disimpan!');
                        inputs.forEach(i => i.setAttribute('disabled', true));
                        fileInput.setAttribute('disabled', true);
                        editBtn.textContent = 'Edit Data';
                        editBtn.classList.remove('bg-green-500', 'hover:bg-green-600', 'text-white');
                        editBtn.classList.add('bg-yellow-500', 'hover:bg-yellow-600', 'text-black');
                    } else {
                        alert('Gagal menyimpan data.');
                    }
                } catch (e) {
                    alert('Terjadi kesalahan: ' + e.message);
                }
            }
        });

        // 🗑️ Tombol Hapus Data
        deleteBtn.addEventListener('click', async () => {
            if (confirm('Apakah kamu yakin ingin menghapus data sekolah ini?')) {
                try {
                    const response = await fetch(`/sekolah/${schoolId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                        }
                    });

                    if (response.ok) {
                        alert('Data sekolah berhasil dihapus!');
                        window.location.href = '/sekolah'; // redirect ke daftar sekolah
                    } else {
                        alert('Gagal menghapus data sekolah.');
                    }
                } catch (e) {
                    alert('Terjadi kesalahan: ' + e.message);
                }
            }
        });
    </script>
</body>

</html>