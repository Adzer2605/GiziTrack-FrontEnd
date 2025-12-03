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
            <h3 class="mb-8 ml-[10%] self-start text-4xl font-bold text-slate-900">Survey Alergi</h3>

            <form action="{{ route('surveyAlergi.post') }}" method="POST"
                class="w-full max-w-3xl rounded-xl border border-gray-200 bg-white p-8 shadow-sm">
                @csrf
                <div class="mb-6 flex items-end gap-4">
                    <div class="flex w-full flex-col gap-2">
                        <label class="text-sm font-bold text-gray-600">Nama Sekolah</label>
                        <div class="relative">
                            <select
                                class="w-full appearance-none rounded-lg border border-gray-300 bg-white px-4 py-3 font-bold text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                name="school" required>
                                <option value="">-- Pilih Sekolah --</option>
                                @foreach ($schools as $school)
                                    <option value="{{ $school->name }}">{{ $school->name }}</option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="mb-[1px] h-[50px] w-32 rounded-lg bg-yellow-500 font-bold text-black transition-colors hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        Kirim
                    </button>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-bold text-gray-600">List Alergi</label>
                    <input
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 font-bold text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        name="allergy" placeholder="Contoh: Kacang, Nanas, Ikan" required>
                </div>
            </form>
        </div>
    </div>
</body>

</html>