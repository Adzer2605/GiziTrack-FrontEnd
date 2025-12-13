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
        document.addEventListener("click", (e) => {
            const checkmarkButton = e.target.closest(".checkmark-btn");
            if (!checkmarkButton) return;

            const box = checkmarkButton.closest(".school-box");

            box.classList.add("bg-gray-100", "opacity-75", "border-gray-300");
            box.classList.remove("bg-white", "hover:border-blue-300", "hover:shadow-md");

            box.parentElement.appendChild(box);
            checkmarkButton.remove();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", async () => {
            const schoolList = document.getElementById("school-list");
            const backendUrl = "{{ config('app.backend_url') }}";

            try {
                const res = await fetch(`${backendUrl}/api/school`, {
                    method: "GET",
                    credentials: "include",
                    headers: {
                        "Accept": "application/json"
                    }
                });

                if (!res.ok) {
                    throw new Error("Gagal mengambil data sekolah");
                }

                const json = await res.json();
                const schools = json.data ?? [];

                schools.forEach(school => {
                    const div = document.createElement("div");
                    div.className = "school-box group mb-4 flex w-4/5 items-center justify-between rounded-lg border-2 border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:border-blue-300 hover:shadow-md";
                    let logoSrc = school.logo;
                    if (!logoSrc.startsWith('http')) {
                        logoSrc = `${backendUrl}/${logoSrc.replace(/^\//, '')}`;
                    }

                    div.innerHTML = `
                    <div class="flex items-center gap-6">
                        <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-lg border border-gray-100 bg-gray-50 p-2">
                            <img src="${logoSrc}" alt="Logo Sekolah" class="h-full w-full object-contain">
                        </div>
                        <div class="text-sm text-gray-700">
                            <p class="mb-1 text-lg font-bold text-slate-900">${school.name}</p>
                            <p class="mb-1 flex items-center gap-2">
                                <span class="font-semibold">Alamat:</span> ${school.location}
                            </p>
                            <p class="flex items-center gap-2">
                                <span class="font-semibold">Jumlah porsi:</span>
                                <span class="rounded-full bg-blue-100 px-2 py-0.5 text-xs font-bold text-blue-800">
                                    ${school.total_meal}
                                </span>
                            </p>
                        </div>
                    </div>

                    <button class="checkmark-btn rounded-full p-2 transition-transform hover:scale-110 hover:bg-green-50 focus:outline-none">
                        <img src="${backendUrl}/images/Checkmark.png" alt="Checkmark" class="h-8 w-8 object-contain">
                    </button>
                `;

                    schoolList.appendChild(div);
                });

            } catch (err) {
                console.error(err);
                alert("Tidak bisa memuat data sekolah");
            }
        });
    </script>
</body>

</html>