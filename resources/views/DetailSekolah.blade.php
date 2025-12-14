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
    const backendUrl = "{{ config('app.backend_url') }}";
    const schoolId = location.pathname.split('/').pop();

    function getToken() {
    const match = document.cookie.match(/api_token=([^;]+)/);
    return match ? match[1] : null;
    }

    function apiFetch(url, options = {}) {
    return fetch(url, {
        ...options,
        headers: {
        ...(options.headers || {}),
        "Accept": "application/json",
        ...(getToken() ? { "Authorization": "Bearer " + getToken() } : {})
        }
    });
    }

    const inputs = document.querySelectorAll("#schoolForm input:not([type=file])");
    const fileInput = document.getElementById("logoInput");
    const logo = document.getElementById("schoolLogo");
    const editBtn = document.getElementById("editBtn");
    const deleteBtn = document.getElementById("deleteBtn");
    const form = document.getElementById("schoolForm");

    document.addEventListener("DOMContentLoaded", async () => {
    try {
        const res = await apiFetch(`${backendUrl}/api/school/${schoolId}`);

        if (res.status === 401) {
        location.href = "/login";
        return;
        }

        const json = await res.json();
        const data = json.data;

        document.getElementById("schoolLogo").src =
        data.logo.startsWith("http")
            ? data.logo
            : `${backendUrl}/${data.logo.replace(/^\/+/, "")}`;

        document.getElementById("name").value = data.name ?? "";
        document.getElementById("location").value = data.location ?? "";
        document.getElementById("total_student").value = data.total_student ?? 0;
        document.getElementById("total_meal").value = data.total_meal ?? 0;
        document.getElementById("type_allergy").value = data.type_allergy ?? "";

    } catch (err) {
        console.error(err);
        alert("Gagal memuat data sekolah");
    }
    });


    fileInput.addEventListener("change", e => {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = () => logo.src = reader.result;
    reader.readAsDataURL(file);
    });

    editBtn.addEventListener("click", async () => {
    const isEditing = editBtn.dataset.editing === "1";

    if (!isEditing) {
        inputs.forEach(i => i.disabled = false);
        fileInput.disabled = false;
        editBtn.textContent = "Simpan Perubahan";
        editBtn.dataset.editing = "1";
        return;
    }

    const formData = new FormData(form);
    formData.append("_method", "PUT");

    try {
        const res = await apiFetch(`${backendUrl}/api/school/${schoolId}`, {
        method: "POST",
        body: formData
        });

        if (!res.ok) {
        alert("Gagal menyimpan perubahan");
        return;
        }

        alert("Data berhasil diperbarui");
        location.reload();
    } catch (err) {
        alert("Terjadi kesalahan jaringan");
    }
    });

    deleteBtn.addEventListener("click", async () => {
    if (!confirm("Yakin ingin menghapus sekolah ini?")) return;

    try {
        const res = await apiFetch(`${backendUrl}/api/school/${schoolId}`, {
        method: "DELETE"
        });

        if (!res.ok) {
        alert("Gagal menghapus data");
        return;
        }

        alert("Sekolah berhasil dihapus");
        location.href = "/sekolah";
    } catch (err) {
        alert("Terjadi kesalahan jaringan");
    }
    });
    </script>

</body>

</html>