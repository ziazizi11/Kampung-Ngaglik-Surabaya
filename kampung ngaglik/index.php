<?php 
// 1. Panggil Header (pastikan file header.php Anda sudah benar)
include 'header.php'; 
// 2. Koneksi ke DB
include 'koneksi/koneksi.php';

// Ambil data untuk konten zigzag di Beranda
$beranda_query = mysqli_query($conn, "SELECT * FROM beranda ORDER BY id DESC");

// Ambil 3 berita/kegiatan terbaru
$kegiatan_terbaru_query = mysqli_query($conn, "SELECT * FROM berita ORDER BY id DESC LIMIT 3");
?>

<title>Selamat Datang di Kampung Ngaglik - Surabaya</title>

<style>
    .hero-banner {
        height: calc(100vh - 5rem);
        position: relative; width: 100%; display: flex;
        align-items: center; justify-content: center;
        text-align: center; color: white;
    }
    .hero-banner::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.2));
    }
    .hero-banner-content { position: relative; z-index: 10; padding: 1rem; }
    .hero-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(2.5rem, 6vw, 4.5rem); font-weight: 700;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
    }
    .hero-subtitle {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(1.1rem, 3vw, 1.5rem); margin-top: 1rem;
        max-width: 600px; margin-left: auto; margin-right: auto;
        text-shadow: 1px 1px 5px rgba(0,0,0,0.5);
    }
</style>

<?php
// Logika untuk Menampilkan Banner
if (basename($_SERVER['PHP_SELF']) == 'index.php') {
    $q = mysqli_query($conn, "SELECT value FROM pengaturan WHERE nama = 'foto benner'");
    $data = mysqli_fetch_assoc($q);
    $banner_image = $data ? $data['value'] : 'benner.png';
?>
    <div class="hero-banner" style="background-image: url('image/<?= htmlspecialchars($banner_image) ?>'); background-size: cover; background-position: center;">
        <div class="hero-banner-content">
            <h1 class="hero-title">Selamat Datang</h1>
            <p class="hero-subtitle">Di Website Resmi Kampung Ngaglik Surabaya</p>
        </div>
    </div>
<?php
}
?>

<div class="bg-white py-20 sm:py-24">
    <div class="container mx-auto px-6 max-w-7xl space-y-20">
        <?php
        $i = 0;
        while ($row = mysqli_fetch_assoc($beranda_query)) {
            $isEven = $i % 2 === 0;
        ?>
        <div class="flex flex-col md:flex-row <?= $isEven ? '' : 'md:flex-row-reverse' ?> items-center gap-12">
            <div class="md:w-1/2">
                <img src="image/<?= htmlspecialchars($row['gambar']) ?>" class="rounded-xl shadow-xl w-full hover:scale-105 transition-transform duration-300" alt="<?= htmlspecialchars($row['judul']) ?>" />
            </div>
            <div class="md:w-1/2">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800" style="font-family: 'Poppins', sans-serif;"><?= htmlspecialchars($row['judul']) ?></h2>
                <div class="w-24 h-1.5 bg-red-500 my-6"></div>
                <div class="article-content text-lg text-gray-600">
                     <?= nl2br(htmlspecialchars($row['deskripsi'])) ?>
                </div>
            </div>
        </div>
        <?php 
            $i++;
        }
        ?>
    </div>
</div>

<div class="py-20 sm:py-24">
    <div class="container mx-auto px-6 max-w-7xl">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800" style="font-family: 'Poppins', sans-serif;">Kegiatan Terbaru</h2>
            <p class="mt-3 text-lg text-gray-600">Ikuti perkembangan dan acara menarik di Kampung Ngaglik.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php while ($row = mysqli_fetch_assoc($kegiatan_terbaru_query)) { ?>
            
            <a href="kegiatan.php?id=<?= $row['id'] ?>" class="kegiatan-card bg-white rounded-xl shadow-lg overflow-hidden flex flex-col transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                
                <img src="image/<?= htmlspecialchars($row['gambar']) ?>" class="w-full h-56 object-cover" alt="<?= htmlspecialchars($row['judul']) ?>">
                
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="text-xl font-bold text-gray-800 clamp-2" style="font-family: 'Poppins', sans-serif;"><?= htmlspecialchars($row['judul']) ?></h3>
                        
                    <div class="article-content clamp-3 mt-3 text-gray-600">
                        <?= nl2br(htmlspecialchars($row['deskripsi_singkat'])) ?>
                    </div>
                </div>

            </a>
            <?php } ?>
        </div>
    </div>
</div>

<?php 
// Panggil Footer
include 'footer.php'; 
?>