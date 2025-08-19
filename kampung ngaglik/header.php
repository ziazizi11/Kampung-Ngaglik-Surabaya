<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="icon" href="image/logo.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7fafc; 
        }
        #main-header {
            background-color: #A5D6A7; /* Warna Hijau */
            transition: box-shadow 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .desktop-nav a {
            position: relative;
            color: rgb(0, 0, 0);
            padding: 8px 0;
            transition: color 0.3s ease;
            font-size: 1.1rem;   
            font-weight: 600;    
        }
        .desktop-nav a:hover, .desktop-nav a.active {
            color: #F9FBE7; /* Warna Krem */
        }
        .desktop-nav a::after {
            content: ''; position: absolute; width: 0; height: 2px;
            bottom: 0; left: 50%; background-color: #F9FBE7;
            transition: all 0.3s ease-out; transform: translateX(-50%);
        }
        .desktop-nav a:hover::after, .desktop-nav a.active::after {
            width: 100%;
        }
        #mobile-menu {
            max-height: 0; overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            background-color: #A5D6A7;
        }
        #mobile-menu.active { max-height: 500px; }
        #mobile-menu a { color: rgb(0, 0, 0); }
        #mobile-menu a:hover { background-color: #81C784; color: white; }
        #mobile-menu a.active { background-color: #66BB6A; color: white; font-weight: 700; }
    </style>
    <script>
        function toggleMobileMenu() {
            document.getElementById('mobile-menu').classList.toggle('active');
        }
    </script>
</head>
<body class="bg-gray-50">

<header id="main-header" class="w-full z-50 fixed top-0 left-0">
    <div class="container mx-auto">
        <div class="h-20 flex items-center justify-between px-6">
            <div class="flex items-center space-x-8">
                <a href="index.php" class="flex-shrink-0">
                    <img class="h-20 w-auto" src="image/logo.png" alt="Logo Kampung Ngaglik">
                </a>
                <nav class="hidden md:flex space-x-6 desktop-nav">
                    <a href="index.php" data-page="index">Beranda</a>
                    <a href="kegiatan.php" data-page="kegiatan">Kegiatan</a>
                    <a href="umkm.php" data-page="umkm">UMKM</a>
                    <a href="agenda.php" data-page="agenda">Agenda</a>
                    <a href="tentang.php" data-page="tentang">Sejarah</a>
                    <a href="alamat.php" data-page="alamat">Tentang Kami</a>
                </nav>
            </div>
            <div class="md:hidden">
                <button class="text-black hover:text-white text-2xl focus:outline-none" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
    <div id="mobile-menu" class="md:hidden border-t border-green-400">
        <div class="px-4 pt-2 pb-4 space-y-1">
            <a class="block py-2 px-3 rounded-md font-medium" href="index.php" data-page="index">Beranda</a>
            <a class="block py-2 px-3 rounded-md font-medium" href="kegiatan.php" data-page="kegiatan">Kegiatan</a>
            </div>
    </div>
</header>

<div class="h-20"></div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const currentPage = window.location.pathname.split('/').pop().replace('.php', '') || 'index';
        document.querySelectorAll('nav a[data-page], #mobile-menu a[data-page]').forEach(link => {
            if (link.getAttribute('data-page') === currentPage) link.classList.add('active');
        });
    });
</script>