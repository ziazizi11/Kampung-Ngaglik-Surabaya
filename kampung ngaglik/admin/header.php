<?php
// session_start() harus ada di baris paling atas di setiap file yang menggunakan session.
// Jika file dashboard.php (atau file lain) sudah memiliki session_start(), ini tidak perlu diulang.
// Namun, menempatkannya di sini sebagai pengaman adalah praktik yang baik.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Admin - Kampung Ngaglik</title><link rel="icon" href="../image/logo.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body, .main-content {
            font-family: 'Poppins', sans-serif;
        }

        /* Fungsionalitas sidebar mobile */
        #sidebar {
            transition: transform 0.3s ease-in-out;
        }
        @media (max-width: 767px) {
            #sidebar {
                transform: translateX(-100%);
            }
            #sidebar.open {
                transform: translateX(0);
            }
            #overlay {
                transition: opacity 0.3s ease-in-out;
            }
        }

        /* Styling untuk scrollbar di sidebar (opsional) */
        #sidebar-nav::-webkit-scrollbar {
            width: 6px;
        }
        #sidebar-nav::-webkit-scrollbar-track {
            background: transparent;
        }
        #sidebar-nav::-webkit-scrollbar-thumb {
            background: #81C784; /* Warna scrollbar disesuaikan */
            border-radius: 3px;
        }
        #sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: #4E342E; /* Warna hover scrollbar disesuaikan */
        }

        /* Styling untuk Status Pills/Badges */
        .status-pill {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }
        .status-aktif, .status-selesai, .status-kegiatan, .status-berita {
            background-color: #dcfce7; /* Hijau muda */
            color: #166534; /* Hijau tua */
        }
        .status-pending, .status-agenda {
            background-color: #fef9c3; /* Kuning muda */
            color: #854d0e; /* Kuning tua */
        }
        .status-umkm {
             background-color: #e0e7ff; /* Biru muda */
             color: #3730a3; /* Biru tua */
        }

    </style>
</head>
<body class="bg-slate-100">

<div class="relative min-h-screen md:flex">
    <div id="overlay" class="fixed inset-0 bg-black/60 z-40 md:hidden opacity-0 pointer-events-none transition-opacity" onclick="toggleMobileMenu()"></div>

    <div id="sidebar" class="bg-[#A5D6A7] text-green-900 w-80 space-y-6 py-4 px-2 absolute inset-y-0 left-0 transform md:relative md:translate-x-0 z-50 flex flex-col">
        
        <a href="dashboard.php" class="flex items-center space-x-3 px-4">
            <img src="../image/logo.png" alt="Logo" class="h-10 w-10">
            <span class="text-slate-800 text-xl font-bold">Admin Panel</span>
        </a>

        <nav id="sidebar-nav">
            <ul class="space-y-2">
                <?php
                $current_page = basename($_SERVER['PHP_SELF']);
                $menu_items = [
                    'dashboard.php' => ['title' => 'Dashboard', 'icon' => 'fa-tachometer-alt'],
                    'uploud_beranda.php' => ['title' => 'Konten Beranda', 'icon' => 'fa-home'],
                    'uploud_benner.php' => ['title' => 'Banner Beranda', 'icon' => 'fa-image'],
                    'uploud_berita.php' => ['title' => 'Upload Kegiatan', 'icon' => 'fa-newspaper'],
                    'umkm.php' => ['title' => 'Data UMKM', 'icon' => 'fa-store'],
                    'uploud_kegiatan.php' => ['title' => 'Upload Agenda', 'icon' => 'fa-calendar-alt'],
                ];
                
                foreach ($menu_items as $file => $item):
                    $isActive = $current_page === $file;
                ?>
                    <li>
                        <a href="<?= $file; ?>" 
                           class="flex items-center py-2.5 px-4 rounded-md transition duration-200 relative
                                  <?= $isActive ? 'bg-green-800 text-white' : 'hover:bg-green-200'; ?>">
                            
                            <?php if($isActive): ?>
                                <span class="absolute left-0 top-0 h-full w-1 bg-green-900 rounded-r-full"></span>
                            <?php endif; ?>

                            <i class="fas <?= $item['icon']; ?> w-6 text-center <?= $isActive ? 'text-white' : 'text-green-800'; ?>"></i>
                            <span class="ml-3 font-medium"><?= $item['title']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <div class="flex-grow"></div>

        <div class="p-2 border-t border-green-200">
            <div class="relative">
                <button id="btn-akun" onclick="toggleDropdown()" class="flex items-center justify-between w-full p-3 hover:bg-green-200 rounded-lg focus:outline-none">
                    <div class="flex items-center">
                        <i class="fas fa-user-circle text-2xl mr-3 text-green-800"></i>
                        <span class="font-semibold text-slate-800">
                            <?= isset($_SESSION['admin_name']) ? htmlspecialchars($_SESSION['admin_name']) : 'Akun'; ?>
                        </span>
                    </div>
                    <i class="fas fa-caret-up text-green-800 transition-transform" id="akun-caret"></i>
                </button>
                <div id="dropdown-akun" class="absolute bottom-full left-0 mb-2 w-full bg-white rounded-md shadow-lg py-1 hidden z-50">
                    <?php if (!isset($_SESSION['admin_id'])): ?>
                        <a href="login.php" class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                            <i class="fas fa-sign-in-alt w-6 mr-2 text-gray-500"></i> Login
                        </a>
                    <?php else: ?>
                        <?php if (isset($_SESSION['admin_role']) && $_SESSION['admin_role'] === 'superadmin'): ?>
                            <a href="register.php" class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                <i class="fas fa-user-plus w-6 mr-2 text-gray-500"></i> Registrasi Admin
                            </a>
                        <?php endif; ?>
                        <a href="proses/logout.php" class="px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center">
                            <i class="fas fa-sign-out-alt w-6 mr-2"></i> Logout
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-1 flex flex-col">
        <header class="bg-white h-16 flex items-center justify-between px-4 md:hidden border-b">
            <button onclick="toggleMobileMenu()" class="text-slate-600 text-2xl focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
            <a href="dashboard.php" class="text-slate-800 text-xl font-bold">Admin Panel</a>
            <div class="w-8"></div> 
        </header>

        <main class="flex-grow p-4 md:p-6 lg:p-8">

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdown-akun');
        const caret = document.getElementById('akun-caret');
        dropdown.classList.toggle('hidden');
        caret.classList.toggle('rotate-180');
    }

    function toggleMobileMenu() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        sidebar.classList.toggle('open');
        overlay.classList.toggle('opacity-0');
        overlay.classList.toggle('pointer-events-none');
    }

    window.addEventListener('click', function(e) {
        const btn = document.getElementById('btn-akun');
        const menu = document.getElementById('dropdown-akun');
        if (btn && menu && !btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
            document.getElementById('akun-caret').classList.remove('rotate-180');
        }
    });
</script>