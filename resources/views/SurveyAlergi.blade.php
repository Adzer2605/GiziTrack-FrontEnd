<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Alergi | GiziTrack</title>
    @vite(['resources/css/app.css'])
</head>

<body class="flex min-h-screen flex-col bg-gray-50 font-sans">
    <x-header />

    <div class="mt-16 flex flex-1">
        <x-layout />

        <div class="flex w-full flex-col items-center py-10">

            <div class="mb-8 w-4/5">
                <h1 class="text-3xl font-bold text-slate-900">Survey Alergi Siswa</h1>
                <p class="mt-2 text-gray-500">Laporkan temuan alergi makanan pada siswa di setiap sekolah.</p>
            </div>

            <form id="surveyForm" action="#" method="POST"
                class="flex w-4/5 flex-col rounded-xl border border-gray-200 bg-white p-8 shadow-sm">
                @csrf

                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">

                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-bold text-gray-600">Nama Sekolah</label>
                        <div class="relative w-full">
                            <select id="schoolSelect"
                                class="w-full appearance-none rounded-lg border border-gray-300 bg-white px-4 py-3 font-bold text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                name="school" required>
                                <option value="">-- Memuat Sekolah... --</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-bold text-gray-600">Daftar Alergi Ditemukan</label>
                        <input id="allergyInput"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            name="allergy" placeholder="Contoh: Kacang, Udang, Telur" required>
                        <p class="text-xs text-gray-400">*Pisahkan dengan koma jika lebih dari satu.</p>
                    </div>

                </div>

                <div class="mt-8 border-t border-gray-100 pt-6">
                    <button type="submit" id="submitBtn"
                        class="w-full rounded-lg bg-yellow-500 py-3.5 text-base font-bold text-slate-900 transition-all hover:bg-yellow-400 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-1 sm:w-auto sm:px-12">
                        Kirim Laporan
                    </button>
                </div>

            </form>
        </div>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", async () => {
    const backendUrl = "{{ config('app.backend_url') }}";
    const schoolSelect = document.getElementById("schoolSelect");
    const surveyForm = document.getElementById("surveyForm");
    const submitBtn = document.getElementById("submitBtn");

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
        const schools = Array.isArray(json.data) ? json.data : [];

        schoolSelect.innerHTML = '<option value="">-- Pilih Sekolah --</option>';

        if (schools.length === 0) {
        schoolSelect.innerHTML =
            '<option value="">Tidak ada data sekolah</option>';
        return;
        }

        schools.forEach(school => {
        const opt = document.createElement("option");
        opt.value = school.name;        // ✅ PAKAI ID
        opt.textContent = school.name;
        schoolSelect.appendChild(opt);
        });

    } catch (err) {
        console.error("Gagal memuat sekolah:", err);
        schoolSelect.innerHTML =
        '<option value="">Gagal memuat data</option>';
    }

    surveyForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const schoolId = schoolSelect.value;
        const allergy  = document.getElementById("allergyInput").value.trim();

        if (!schoolId) {
        alert("Silakan pilih sekolah terlebih dahulu");
        return;
        }

        const originalText = submitBtn.innerText;
        submitBtn.innerText = "Mengirim...";
        submitBtn.disabled = true;

        try {
        const res = await fetch(`${backendUrl}/api/survey/allergy`, {
            method: "POST",
            credentials: "include",
            headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            ...(getToken() ? { "Authorization": "Bearer " + getToken() } : {})
            },
            body: JSON.stringify({
            school: schoolId,
            allergy: allergy
            })
        });

        if (res.status === 401) {
            location.href = "/login";
            return;
        }

        const json = await res.json();

        if (!res.ok) {
            let msg = json.message || "Gagal mengirim laporan";
            if (json.errors) {
            msg += "\n" + Object.values(json.errors).flat().join("\n");
            }
            alert(msg);
            return;
        }

        alert("Laporan berhasil dikirim!");
        surveyForm.reset();

        } catch (err) {
        console.error("Error:", err);
        alert("Terjadi kesalahan jaringan");
        } finally {
        submitBtn.innerText = originalText;
        submitBtn.disabled = false;
        }
    });
    });
</script>
</body>

</html>