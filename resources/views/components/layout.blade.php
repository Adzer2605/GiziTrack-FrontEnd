<!-- Burger Menu Button -->
<button id="burger-btn"
    class="fixed top-20 left-4 z-50 flex h-12 w-12 flex-col items-center justify-center gap-1.5 rounded-lg bg-slate-900 shadow-lg transition-all duration-300 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-400">
    <span class="burger-line block h-0.5 w-6 rounded-full bg-white transition-all duration-300"></span>
    <span class="burger-line block h-0.5 w-6 rounded-full bg-white transition-all duration-300"></span>
    <span class="burger-line block h-0.5 w-6 rounded-full bg-white transition-all duration-300"></span>
</button>

<!-- Overlay -->
<div id="sidebar-overlay"
    class="fixed inset-0 top-16 z-40 bg-black/50 opacity-0 pointer-events-none transition-opacity duration-300"></div>

<!-- Sidebar Menu -->
<div id="sidebar-menu"
    class="fixed top-16 bottom-0 left-0 z-40 flex w-64 flex-col items-center justify-between bg-slate-900 py-6 text-white shadow-xl transition-transform duration-300 ease-in-out -translate-x-full">
    <div class="mt-16 flex w-full flex-col items-center space-y-3 px-4">
        <form action="{{ route('beranda') }}" method="get" class="w-full">
            <button type="submit"
                class="w-full rounded-lg bg-white py-2.5 text-sm font-bold text-gray-900 transition-colors hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-400">
                Beranda
            </button>
        </form>

        <form action="{{ route('sekolah') }}" method="get" class="w-full">
            <button type="submit"
                class="w-full rounded-lg bg-white py-2.5 text-sm font-bold text-gray-900 transition-colors hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-400">
                Sekolah
            </button>
        </form>

        <form action="{{ route('surveyMakanan') }}" method="get" class="w-full">
            <button type="submit"
                class="w-full rounded-lg bg-white py-2.5 text-sm font-bold text-gray-900 transition-colors hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-400">
                Survey Makanan
            </button>
        </form>

        <form action="{{ route('surveyAlergi') }}" method="get" class="w-full">
            <button type="submit"
                class="w-full rounded-lg bg-white py-2.5 text-sm font-bold text-gray-900 transition-colors hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-400">
                Survey Alergi
            </button>
        </form>
    </div>

    <form action="{{ route('logout') }}" method="post" class="w-full px-4">
        @csrf
        <button type="submit"
            class="w-full rounded-lg bg-red-600 py-2.5 text-sm font-bold text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-slate-900">
            Log Out
        </button>
    </form>
</div>

<!-- JavaScript untuk Toggle Menu -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const burgerBtn = document.getElementById('burger-btn');
        const sidebarMenu = document.getElementById('sidebar-menu');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const burgerLines = document.querySelectorAll('.burger-line');
        let isOpen = false;

        // Toggle sidebar function
        const toggleSidebar = () => {
            isOpen = !isOpen;

            if (isOpen) {
                // Muncul: animasi kiri ke kanan
                sidebarMenu.classList.remove('-translate-x-full');
                sidebarMenu.classList.add('translate-x-0');
                sidebarOverlay.classList.remove('pointer-events-none', 'opacity-0');
                sidebarOverlay.classList.add('pointer-events-auto', 'opacity-100');

                // Animasi burger menjadi X
                burgerLines[0].classList.add('rotate-45', 'translate-y-2');
                burgerLines[1].classList.add('opacity-0');
                burgerLines[2].classList.add('-rotate-45', '-translate-y-2');
            } else {
                // Hilang: animasi kanan ke kiri
                sidebarMenu.classList.remove('translate-x-0');
                sidebarMenu.classList.add('-translate-x-full');
                sidebarOverlay.classList.remove('pointer-events-auto', 'opacity-100');
                sidebarOverlay.classList.add('pointer-events-none', 'opacity-0');

                // Kembalikan burger ke bentuk awal
                burgerLines[0].classList.remove('rotate-45', 'translate-y-2');
                burgerLines[1].classList.remove('opacity-0');
                burgerLines[2].classList.remove('-rotate-45', '-translate-y-2');
            }
        };

        // Event listeners
        burgerBtn.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // Close menu when pressing Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isOpen) {
                toggleSidebar();
            }
        });
    });
</script>