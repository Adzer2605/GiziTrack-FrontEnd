<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | GiziTrack</title>
  @vite(['resources/css/app.css', 'resources/js/app.tsx'])
</head>

<body class="flex min-h-screen items-center justify-center bg-gradient-to-br from-[#B2EBF2] to-[#B2DFDB] font-sans">

  <div
    class="flex w-full max-w-[400px] flex-col items-center rounded-[20px] bg-white px-8 py-10 shadow-[0_4px_15px_rgba(0,0,0,0.1)]">
    <img src="{{ secure_asset('images/GiziTrackLogo.png') }}" alt="Logo GiziTrack" class="mb-2 w-20 object-contain">
    <div class="mb-1 text-[22px] font-bold text-black">Gizi Track</div>
    <div class="mb-8 text-[28px] font-extrabold text-black">Login</div>

    <form id="loginForm" method="POST" class="flex w-full flex-col">
      @csrf

      <label class="mb-2 ml-1 text-sm font-bold text-gray-800">Masukkan Username</label>
      <input type="text" name="username" id="username" placeholder="Username"
        class="mb-5 w-full rounded-full border border-gray-800 px-5 py-3 text-base outline-none placeholder-gray-500 focus:border-[#0a1f44] focus:ring focus:ring-[#0a1f44]/30"
        required>

      <label class="mb-2 ml-1 text-sm font-bold text-gray-800">Masukkan Password</label>
      <input type="password" name="password" id="password" placeholder="Password"
        class="mb-5 w-full rounded-full border border-gray-800 px-5 py-3 text-base outline-none placeholder-gray-500 focus:border-[#0a1f44] focus:ring focus:ring-[#0a1f44]/30"
        required>

      <button type="submit" id="submitBtn"
        class="mt-2 w-auto px-12 self-center rounded-full bg-[#0a1f44] py-3 text-lg font-bold text-white transition-all duration-300 hover:bg-[#b3e0e5] hover:text-[#0a1f44]">
        Login
      </button>

    </form>

    <script>
      document.getElementById('loginForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const btn = document.getElementById('submitBtn');
        const originalText = btn.innerText;
        btn.innerText = 'Loading...';
        btn.disabled = true;

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const backendUrl = "{{ config('app.backend_url') }}";

        try {
          const response = await fetch(`${backendUrl}/api/login`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
            credentials: 'include',
            body: JSON.stringify({ username, password })
          });

          const data = await response.json();

          if (response.ok) {
            window.location.href = "/beranda";
          } else {
            alert(data.message || 'Login gagal di server backend');
            btn.innerText = originalText;
            btn.disabled = false;
          }
        } catch (error) {
          console.error('Error:', error);
          alert('Gagal menghubungi server backend');
          btn.innerText = originalText;
          btn.disabled = false;
        }
      });
    </script>
  </div>

</body>

</html>