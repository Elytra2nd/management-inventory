<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMENTUR Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.3/sweetalert2.all.min.js"></script>
    <style>
        .gradient-background {
            background: linear-gradient(135deg, #1e3c72 0%, #1e3c72 1%, #2a5298 100%);
        }
        .menu-card {
            transition: all 0.3s ease;
        }
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .kelola-card {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
        }
        .kelola-card:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }
        .laporan-card {
            background: linear-gradient(135deg, #4b5563 0%, #6b7280 100%);
        }
        .laporan-card:hover {
            background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
        }
    </style>
</head>
<body class="gradient-background min-h-screen flex items-center justify-center py-12">
    <div class="container mx-auto px-4 max-w-5xl">
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-6xl font-bold text-white mb-4 tracking-wide">SIMENTUR</h1>
            <p class="text-xl text-gray-200 tracking-wide">Sistem Informasi Manajemen Inventory Furniture</p>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-3xl shadow-2xl p-8 mx-4 relative border border-white border-opacity-20">
            <!-- Logout Button -->
            <div class="absolute top-6 right-6">
                <button onclick="confirmLogout()"
                        class="flex items-center space-x-2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg transition-all duration-300">
                    <span class="text-sm font-medium">Log out</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </button>
            </div>

            <!-- Welcome Message -->
            <div class="text-center mb-12">
                <p class="text-white text-xl">Selamat datang, <span class="font-semibold">{{ session('nama_pengelola') }}</span></p>
            </div>

            <!-- Menu Cards - Side by Side -->
            <div class="grid grid-cols-2 gap-6 mb-12">
                <!-- Kelola Inventory Card -->
                <a href="{{ route('inventory.index') }}" class="group">
                    <div class="menu-card kelola-card h-32 rounded-xl p-4 flex items-center justify-center text-center transition-all duration-300">
                        <div class="flex flex-col items-center">
                            <svg class="w-8 h-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <h2 class="text-xl font-bold text-white tracking-wide">KELOLA INVENTORY</h2>
                        </div>
                    </div>
                </a>

                <!-- Laporan Inventory Card -->
                <a href="{{ route('laporan.index') }}" class="group">
                    <div class="menu-card laporan-card h-32 rounded-xl p-4 flex items-center justify-center text-center transition-all duration-300">
                        <div class="flex flex-col items-center">
                            <svg class="w-8 h-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h2 class="text-xl font-bold text-white tracking-wide">LAPORAN INVENTORY</h2>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-2 gap-6">
                <div class="bg-white bg-opacity-10 rounded-xl p-4 text-center">
                    <p class="text-gray-200 text-sm mb-1">Total Inventory</p>
                    <p class="text-3xl font-bold text-white">{{ $totalInventory }}</p>
                </div>
                <div class="bg-white bg-opacity-10 rounded-xl p-4 text-center">
                    <p class="text-gray-200 text-sm mb-1">Total Laporan</p>
                    <p class="text-3xl font-bold text-white">{{ $totalLaporan }}</p>
                </div>
            </div>
        </div>

        <!-- Hidden Logout Form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: "Apakah Anda yakin ingin keluar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#4b5563',
                confirmButtonText: 'Ya, Logout!',
                cancelButtonText: 'Batal',
                background: '#fff',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-lg px-6 py-2',
                    cancelButton: 'rounded-lg px-6 py-2'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
</body>
</html>
