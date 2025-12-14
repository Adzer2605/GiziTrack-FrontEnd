<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sekolah | GiziTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
</head>

<body class="flex min-h-screen flex-col bg-gray-50 font-sans">
    <x-header />
    <div class="mt-16 flex flex-1">
        <x-layout />

        <div class="flex w-full flex-col items-center py-10">
            <div class="mb-8 flex w-4/5 items-center justify-between">
                <h2 class="text-3xl font-bold text-slate-900">Data Sekolah</h2>
            </div>


            <div class="mb-8 w-4/5">
                <a href="/sekolah/create"
                    class="inline-block w-fit rounded-lg bg-yellow-500 px-6 py-2.5 text-sm font-bold text-black transition-colors hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2">
                    Tambah Data
                </a>
            </div>

            <div class="grid w-4/5 grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5" id="school-grid">
            </div>
        </div>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", async () => {
    const backendUrl = "{{ config('app.backend_url') }}";
    const container = document.getElementById("school-grid");

    function getToken() {
        const m = document.cookie.match(/api_token=([^;]+)/);
        return m ? m[1] : null;
    }

    try {
        const res = await fetch(`${backendUrl}/api/school`, {
        method: "GET",
        credentials: "include",
        headers: {
            "Accept": "application/json",
            ...(getToken() ? { "Authorization": "Bearer " + getToken() } : {})
        }
        });

        if (res.status === 401) {
        location.href = "/login";
        return;
        }

        if (!res.ok) {
        throw new Error("Gagal mengambil data sekolah");
        }

        const json = await res.json();
        const data = Array.isArray(json.data) ? json.data : [];

        container.innerHTML = "";

        if (data.length === 0) {
        container.innerHTML =
            '<p class="col-span-full text-center text-gray-500">Tidak ada data sekolah.</p>';
        return;
        }

        data.forEach(school => {
        const logoSrc = school.logo
            ? (school.logo.startsWith("http")
                ? school.logo
                : `${backendUrl}/${school.logo.replace(/^\/+/, "")}`)
            : `${backendUrl}/images/placeholder.png`;

        container.insertAdjacentHTML("beforeend", `
            <a href="/sekolah/${school.id}"
            class="group flex flex-col items-center rounded-xl border border-gray-200 bg-white p-4 text-center shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-blue-200">
            <div class="mb-4 flex h-32 w-full items-center justify-center rounded-lg bg-yellow-50 p-2">
                <img src="${logoSrc}"
                    class="h-full w-full object-contain"
                    alt="Logo ${school.name ?? ''}">
            </div>
            <p class="text-base font-bold text-gray-800 group-hover:text-blue-600">
                ${school.name ?? "-"}
            </p>
            </a>
        `);
        });

    } catch (err) {
        console.error("Fetch Error:", err);
        container.innerHTML =
        '<p class="col-span-full text-center text-red-600">Gagal memuat data sekolah.</p>';
    }
    });
</script>

</body>

</html>