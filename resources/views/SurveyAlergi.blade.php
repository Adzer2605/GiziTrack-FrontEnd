<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Alergi | GiziTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col bg-gray-50 font-sans">
    <x-header />

    <div class="mt-16 flex flex-1">
        <x-layout />

        <div class="flex w-full flex-col items-center py-10">
            
            <!-- Header Section -->
            <div class="mb-8 w-4/5">
                <h1 class="text-3xl font-bold text-slate-900">Survey Alergi Siswa</h1>
                <p class="mt-2 text-gray-500">Laporkan temuan alergi makanan pada siswa di setiap sekolah.</p>
            </div>

            <form action="{{ route('surveyAlergi.post') }}" method="POST"
                class="flex w-4/5 flex-col rounded-xl border border-gray-200 bg-white p-8 shadow-sm">
                @csrf

                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                    
                    <!-- INPUT 1: PILIH SEKOLAH -->
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-bold text-gray-600">Nama Sekolah</label>
                        <div class="relative w-full">
                            <select
                                class="w-full appearance-none rounded-lg border border-gray-300 bg-white px-4 py-3 font-bold text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                name="school" required>
                                <option value="">-- Pilih Sekolah --</option>
                                @foreach ($schools as $school)
                                    <option value="{{ $school->name }}">{{ $school->name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- INPUT 2: LIST ALERGI -->
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-bold text-gray-600">Daftar Alergi Ditemukan</label>
                        <input
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            name="allergy" placeholder="Contoh: Kacang, Udang, Telur" required>
                        <p class="text-xs text-gray-400">*Pisahkan dengan koma jika lebih dari satu.</p>
                    </div>

                </div>

                <!-- ACTION BUTTON -->
                <div class="mt-8 border-t border-gray-100 pt-6">
                    <button type="submit"
                        class="w-full rounded-lg bg-yellow-500 py-3.5 text-base font-bold text-slate-900 transition-all hover:bg-yellow-400 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-1 sm:w-auto sm:px-12">
                        Kirim Laporan
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>