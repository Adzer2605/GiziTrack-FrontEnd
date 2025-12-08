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

                <div class="w-full rounded-lg bg-blue-100 p-3 text-center text-lg font-bold text-blue-900">
                    {{ $account->office }}
                </div>
            </div>

            <div class="w-full max-w-2xl space-y-4">
                @foreach ($account->employees as $employee)
                    <div
                        class="flex flex-col gap-2 rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition-shadow hover:shadow-md">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-2">
                            <span class="text-sm font-medium text-gray-500">ID Karyawan</span>
                            <span class="font-bold text-gray-900">{{ $employee->id }}</span>
                        </div>
                        <div class="flex items-center justify-between pt-2">
                            <span class="text-sm font-medium text-gray-500">Nama Karyawan</span>
                            <span class="text-lg font-bold text-gray-900">{{ $employee->name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>