<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | GiziTrack</title>
  @vite(['resources/css/app.css', 'resources/js/app.tsx'])
</head>
<body class="flex min-h-screen w-full flex-col md:flex-row">
  <!-- Left Section (Form) -->
  <div class="flex flex-1 flex-col items-center justify-center bg-slate-900 p-8 text-center md:p-12">
    <div class="w-full max-w-md">
      <h2 class="mb-8 text-3xl font-bold text-white">Gizi Track</h2>
      
      <form action="{{ route('register.post') }}" method="POST" class="flex flex-col items-center gap-4">
        @csrf
        <div class="w-full">
            <input type="text" 
                   class="w-full rounded-lg border-none bg-white px-4 py-3 text-center text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   name="username" 
                   placeholder="Username" 
                   required>
        </div>
        
        <div class="w-full">
            <input type="password" 
                   class="w-full rounded-lg border-none bg-white px-4 py-3 text-center text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   name="password" 
                   placeholder="Password" 
                   required>
        </div>

        <div class="w-full">
            <input type="text" 
                   class="w-full rounded-lg border-none bg-white px-4 py-3 text-center text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   name="office" 
                   placeholder="Office" 
                   required>
        </div>

        <div class="w-full">
            <input type="text" 
                   class="w-full rounded-lg border-none bg-white px-4 py-3 text-center text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   name="employee" 
                   placeholder="Employee ID" 
                   required>
        </div>

        <button type="submit" 
                class="mt-4 w-auto rounded-lg bg-blue-500 px-8 py-2.5 text-base font-bold text-white transition-colors hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 focus:ring-offset-slate-900">
          Register
        </button>
      </form>

      <div class="mt-6 text-sm text-white">
        Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-blue-400 hover:underline">Login disini</a>
      </div>
    </div>
  </div>

  <!-- Right Section (Images) -->
  <div class="flex flex-1 flex-col items-center justify-center bg-white p-8 md:p-12">
    <div class="flex w-full max-w-lg flex-col gap-6">
        <img src="{{ asset('images/login-images.webp') }}" alt="Healthy Food" class="h-64 w-full rounded-xl object-cover shadow-lg md:h-80">
        
        <div class="flex gap-4">
            <div class="h-40 w-1/2 overflow-hidden rounded-xl shadow-md">
                <img src="{{ asset('images/login-images2.webp') }}" alt="Healthy Lifestyle" class="h-full w-full object-cover transition-transform hover:scale-105">
            </div>
            <div class="h-40 w-1/2 overflow-hidden rounded-xl shadow-md">
                <img src="{{ asset('images/login-images3.webp') }}" alt="Nutrition" class="h-full w-full object-cover transition-transform hover:scale-105">
            </div>
        </div>
    </div>
  </div>
</body>
</html>
