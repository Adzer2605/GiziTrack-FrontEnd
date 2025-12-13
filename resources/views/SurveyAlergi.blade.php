<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Alergi | GiziTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
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
            const schoolSelect = document.getElementById('schoolSelect');
            const surveyForm = document.getElementById('surveyForm');
            const submitBtn = document.getElementById('submitBtn');
            const backendUrl = "{{ config('app.backend_url') }}";

            try {
                const response = await fetch(`${backendUrl}/api/school`, {
                    method: 'GET',
                    headers: { 'Accept': 'application/json' },
                    credentials: 'include'
                });
                const json = await response.json();

                schoolSelect.innerHTML = '<option value="">-- Pilih Sekolah --</option>';

                if (json.data && Array.isArray(json.data)) {
                    json.data.forEach(school => {
                        const option = document.createElement('option');
                        option.value = school.name;
                        option.textContent = school.name;
                        schoolSelect.appendChild(option);
                    });
                }
            } catch (error) {
                console.error('Gagal memuat sekolah:', error);
                schoolSelect.innerHTML = '<option value="">Gagal memuat data</option>';
            }

            surveyForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const originalText = submitBtn.innerText;
                submitBtn.innerText = 'Mengirim...';
                submitBtn.disabled = true;

                const school = schoolSelect.value;
                const allergy = document.getElementById('allergyInput').value;

                try {
                    const response = await fetch(`${backendUrl}/api/survey/allergy`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        credentials: 'include',
                        body: JSON.stringify({ school, allergy })
                    });

                    const data = await response.json();

                    if (response.ok) {
                        alert('Laporan berhasil dikirim!');
                        surveyForm.reset();
                    } else {
                        let message = data.message || 'Gagal mengirim laporan';
                        if (data.errors) {
                            message += '\n' + Object.values(data.errors).flat().join('\n');
                        }
                        alert(message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan jaringan');
                } finally {
                    submitBtn.innerText = originalText;
                    submitBtn.disabled = false;
                }
            });
        });
    </script>
</body>

</html>