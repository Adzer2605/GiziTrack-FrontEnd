<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | GiziTrack</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen items-center justify-center bg-gradient-to-br from-[#B2EBF2] to-[#B2DFDB] font-sans">

  <div class="flex w-full max-w-[400px] flex-col items-center rounded-[20px] bg-white px-8 py-10 shadow-[0_4px_15px_rgba(0,0,0,0.1)]">
    <img src="{{ asset('images/GiziTrackLogo.png') }}" alt="Logo GiziTrack" class="mb-2 w-20 object-contain">
    <div class="mb-1 text-[22px] font-bold text-black">Gizi Track</div>
    <div class="mb-8 text-[28px] font-extrabold text-black">Login</div>

    <form action="{{ route('login.post') }}" method="POST" class="flex w-full flex-col">
      @csrf
      
      <!-- Username Input -->
      <label class="mb-2 ml-1 text-sm font-bold text-gray-800">Masukkan Username</label>
      <input type="text" 
             name="username" 
             placeholder="Username"
             class="mb-5 w-full rounded-full border border-gray-800 px-5 py-3 text-base outline-none placeholder-gray-500 focus:border-[#0a1f44] focus:ring focus:ring-[#0a1f44]/30"
             required>

      <!-- Password Input -->
      <label class="mb-2 ml-1 text-sm font-bold text-gray-800">Masukkan Password</label>
      <input type="password" 
             name="password" 
             placeholder="Password"
             class="mb-5 w-full rounded-full border border-gray-800 px-5 py-3 text-base outline-none placeholder-gray-500 focus:border-[#0a1f44] focus:ring focus:ring-[#0a1f44]/30"
             required>

      <!-- Button Login (Sudah Diperpendek) -->
      <!-- PERUBAHAN: w-[80%] diganti menjadi w-auto px-12 -->
      <button type="submit" 
              class="mt-2 w-auto px-12 self-center rounded-full bg-[#0a1f44] py-3 text-lg font-bold text-white transition-all duration-300 hover:bg-[#b3e0e5] hover:text-[#0a1f44]">
        Login
      </button>

    </form>
  </div>

</body>
</html>