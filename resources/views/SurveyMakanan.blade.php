<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Makanan | GiziTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col bg-gray-50 font-sans">
    <x-header />

    <div class="mt-16 flex flex-1">
        <x-layout />

        <div class="flex w-full flex-col items-center py-10">
            
            <!-- Header Section -->
            <div class="mb-8 w-4/5">
                <h1 class="text-3xl font-bold text-slate-900">Survey Makanan Tidak Dimakan</h1>
                <p class="mt-2 text-gray-500">Silakan input data sisa makanan berdasarkan sampel siswa.</p>
            </div>

            <form action="{{ route('surveyMakanan.post') }}" method="POST"
                class="flex w-4/5 flex-col rounded-xl border border-gray-200 bg-white p-8 shadow-sm">
                @csrf

                <!-- SECTION 1: PILIH SEKOLAH -->
                <div class="mb-8 border-b border-gray-100 pb-8">
                    <label for="school" class="mb-2 block text-sm font-bold text-gray-600">Nama Sekolah</label>
                    <div class="relative w-full max-w-xl">
                        <select id="school"
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

                <!-- SECTION 2: INPUT MAKANAN (GRID LAYOUT) -->
                <div class="mb-6">
                    <h3 class="mb-4 text-lg font-bold text-slate-900">Input Data Makanan</h3>
                    
                    <!-- Grid System: 1 kolom di HP, 2 kolom di Laptop agar lebih efisien -->
                    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
                        @for ($i = 1; $i <= 6; $i++)
                            <div class="flex items-start gap-4 rounded-xl border border-gray-100 bg-gray-50 p-4 transition-colors hover:border-blue-200">
                                <!-- Penomoran kecil -->
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-100 text-sm font-bold text-blue-600">
                                    {{ $i }}
                                </div>

                                <div class="flex w-full gap-4">
                                    <!-- Input Nama Makanan -->
                                    <div class="w-full flex-1">
                                        <label for="food_{{ $i }}" class="mb-1 block text-xs font-bold text-gray-500 uppercase">Nama Makanan</label>
                                        <input id="food_{{ $i }}"
                                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 font-bold text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                            name="food[]" 
                                            placeholder="Contoh: Nasi Goreng"
                                            oninput="this.value=this.value.replace(/[^a-zA-Z0-9\s.,-]/g,'')">
                                    </div>

                                    <!-- Input Jumlah -->
                                    <div class="w-24 shrink-0 sm:w-32">
                                        <label for="total_{{ $i }}" class="mb-1 block text-xs font-bold text-gray-500 uppercase">Jumlah</label>
                                        <div class="relative">
                                            <input id="total_{{ $i }}"
                                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 font-bold text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                                name="total[]" 
                                                placeholder="0"
                                                oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                            <span class="absolute right-3 top-2.5 text-xs font-bold text-gray-400">Porsi</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- BUTTON ACTION -->
                <div class="mt-4 border-t border-gray-100 pt-6">
                    <button type="submit"
                        class="w-full rounded-lg bg-yellow-500 py-3.5 text-base font-bold text-slate-900 transition-all hover:bg-yellow-400 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-1 sm:w-auto sm:px-12">
                        Kirim Survey
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>