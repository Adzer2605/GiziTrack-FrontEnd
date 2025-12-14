<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil | GiziTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
</head>

<body class="flex min-h-screen flex-col bg-gray-50 font-sans">
    <x-header />

    <div class="mt-16 flex flex-1">
        <x-layout />

        <div class="flex w-full flex-col items-center py-10">
            <div class="mb-8 flex w-full max-w-2xl flex-col items-center gap-4">
                <div
                    class="flex h-40 w-full items-center justify-center rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <img src="{{ asset('images/GiziTrackLogo.png') }}" alt="Logo GiziTrack"
                        class="h-full w-auto object-contain">
                </div>

                <div id="office-name"
                    class="w-full rounded-lg bg-blue-100 p-3 text-center text-lg font-bold text-blue-900">
                    Loading...
                </div>
            </div>

            <div id="employee-list" class="w-full max-w-2xl space-y-4">
            </div>
        </div>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", async () => {
    const officeNameEl = document.getElementById("office-name");
    const employeeListEl = document.getElementById("employee-list");
    const backendUrl = "{{ config('app.backend_url') }}";

    function getToken() {
        const match = document.cookie.match(/api_token=([^;]+)/);
        return match ? match[1] : null;
    }

    try {
        const res = await fetch(`${backendUrl}/api/profile`, {
        method: "GET",
        credentials: "include",
        headers: {
            "Accept": "application/json",
            ...(getToken() ? { "Authorization": "Bearer " + getToken() } : {})
        }
        });

        if (res.status === 401) {
        window.location.href = "/login";
        return;
        }

        if (!res.ok) {
        throw new Error("Gagal mengambil data profil");
        }

        const json = await res.json();
        const data = json.data ?? {};

        officeNameEl.textContent = data.office || "-";
        officeNameEl.classList.remove("text-red-600", "bg-red-100");
        officeNameEl.classList.add("text-blue-900", "bg-blue-100");

        employeeListEl.innerHTML = "";

        if (Array.isArray(data.employees) && data.employees.length > 0) {
        data.employees.forEach(emp => {
            const card = document.createElement("div");
            card.className =
            "flex flex-col gap-2 rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition-shadow hover:shadow-md";

            card.innerHTML = `
            <div class="flex items-center justify-between border-b border-gray-100 pb-2">
                <span class="text-sm font-medium text-gray-500">ID Karyawan</span>
                <span class="font-bold text-gray-900">${emp.id}</span>
            </div>
            <div class="flex items-center justify-between pt-2">
                <span class="text-sm font-medium text-gray-500">Nama Karyawan</span>
                <span class="text-lg font-bold text-gray-900">${emp.name}</span>
            </div>
            `;

            employeeListEl.appendChild(card);
        });
        } else {
        employeeListEl.innerHTML =
            '<p class="text-center text-gray-500">Tidak ada data karyawan.</p>';
        }

    } catch (err) {
        console.error(err);
        officeNameEl.textContent = "Gagal memuat data";
        officeNameEl.classList.remove("text-blue-900", "bg-blue-100");
        officeNameEl.classList.add("text-red-600", "bg-red-100");
    }
    });
</script>
</body>

</html>