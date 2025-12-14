<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | GiziTrack</title>
    @vite(['resources/css/app.css'])
</head>

<body class="flex min-h-screen flex-col bg-gray-50 font-sans">
    <x-header />

    <div class="mt-16 flex flex-1">
        <x-layout />
        <div class="flex w-full flex-col items-center py-10" id="school-list">
            <h2 class="mb-6 ml-[10%] self-start text-4xl font-bold text-slate-900">Beranda</h2>
        </div>
    </div>

    
    <script>
        const backendUrl = "{{ config('app.backend_url') }}";

        function getApiToken() {
        const match = document.cookie.match(/(^| )api_token=([^;]+)/);
        return match ? match[2] : null;
        }

        async function apiFetch(url, options = {}) {
        const token = getApiToken();

        return fetch(url, {
            ...options,
            headers: {
            ...(options.headers || {}),
            "Accept": "application/json",
            ...(token ? { "Authorization": "Bearer " + token } : {})
            }
        });
        }

        apiFetch(`${backendUrl}/api/profile`)
        .then(res => {
            if (res.status === 401) {
            location.href = "/login";
            return null;
            }
            return res.json();
        })
        .then(data => {
            if (data) {
            console.log("PROFILE:", data);
            }
        })
        .catch(err => {
            console.error("Profile error:", err);
        });

        document.addEventListener("DOMContentLoaded", async () => {
        const schoolList = document.getElementById("school-list");

        try {
            const res = await apiFetch(`${backendUrl}/api/school`);
            if (!res.ok) throw new Error("Gagal mengambil data sekolah");

            const json = await res.json();
            const schools = json.data || [];

            schools.forEach(school => {
            const div = document.createElement("div");
            div.className =
                "school-box group mb-4 flex w-4/5 items-center justify-between rounded-lg border-2 border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:border-blue-300 hover:shadow-md";

            let logoSrc = school.logo;
            if (!logoSrc.startsWith("http")) {
                logoSrc = `${backendUrl}/${logoSrc.replace(/^\/+/, "")}`;
            }

            div.innerHTML = `
                <div class="flex items-center gap-6">
                <div class="flex h-20 w-20 items-center justify-center overflow-hidden rounded-lg border bg-gray-50 p-2">
                    <img src="${logoSrc}" alt="Logo Sekolah" class="h-full w-full object-contain">
                </div>
                <div class="text-sm text-gray-700">
                    <p class="mb-1 text-lg font-bold text-slate-900">${school.name}</p>
                    <p class="mb-1"><strong>Alamat:</strong> ${school.location}</p>
                    <p>
                    <strong>Jumlah porsi:</strong>
                    <span class="rounded-full bg-blue-100 px-2 py-0.5 text-xs font-bold text-blue-800">
                        ${school.total_meal}
                    </span>
                    </p>
                </div>
                </div>

                <button class="checkmark-btn rounded-full p-2 transition-transform hover:scale-110 hover:bg-green-50">
                <img src="${backendUrl}/images/Checkmark.png" class="h-8 w-8">
                </button>
            `;

            schoolList.appendChild(div);
            });

        } catch (err) {
            console.error(err);
            alert("Tidak bisa memuat data sekolah");
        }
        });

        document.addEventListener("click", e => {
        const btn = e.target.closest(".checkmark-btn");
        if (!btn) return;

        const box = btn.closest(".school-box");
        box.classList.add("bg-gray-100", "opacity-75", "border-gray-300");
        box.classList.remove("bg-white", "hover:border-blue-300", "hover:shadow-md");

        box.parentElement.appendChild(box);
        btn.remove();
        });
    </script>
</body>

</html>