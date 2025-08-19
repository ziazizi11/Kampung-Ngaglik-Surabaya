<?php 
// Memanggil header yang konsisten
include 'header.php'; 
// Koneksi ke database
include 'koneksi/koneksi.php';

// --- LOGIKA PENGAMBILAN DATA DETAIL ---

// 1. Dapatkan ID dari URL, pastikan itu adalah angka
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Jika tidak ada ID, redirect ke halaman utama kegiatan
if ($id <= 0) {
    header("Location: kegiatan.php");
    exit();
}

// 2. Siapkan query untuk mengambil data dari tabel 'berita' berdasarkan ID
// Menggunakan prepared statement untuk keamanan dari SQL Injection
$query = "SELECT * FROM berita WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$kegiatan = mysqli_fetch_assoc($result);

// 3. Jika data dengan ID tersebut tidak ditemukan, tampilkan pesan error
if (!$kegiatan) {
    // Set judul sebelum menampilkan pesan error
    echo "<title>Kegiatan Tidak Ditemukan</title>";
    echo "<div class='container mx-auto text-center py-20'>
            <h1 class='text-4xl font-bold text-gray-800'>404 - Tidak Ditemukan</h1>
            <p class='text-gray-600 mt-4'>Maaf, kegiatan yang Anda cari tidak dapat ditemukan.</p>
            <a href='kegiatan.php' class='mt-8 inline-block bg-red-500 text-white font-semibold py-2 px-6 rounded-lg hover:bg-red-600'>Kembali ke Daftar Kegiatan</a>
          </div>";
    // Hentikan eksekusi sisa halaman
    include 'footer.php'; // Panggil footer jika ada
    exit();
}
?>

<title><?= htmlspecialchars($kegiatan['judul']) ?> - Kampung Ngaglik</title>

<div class="bg-white py-12 md:py-20">
    <div class="container mx-auto max-w-4xl px-6">
        
        <h1 class="text-3xl md:text-5xl font-bold heading-font text-gray-900 leading-tight">
            <?= htmlspecialchars($kegiatan['judul']) ?>
        </h1>
        
        <p class="text-base text-gray-500 mt-4 mb-8">
            <i class="far fa-calendar-alt mr-2"></i>Dipublikasikan pada <?= date('d F Y', strtotime($kegiatan['created_at'])) ?>
        </p>
        
        <img class="w-2/3 block mx-auto rounded-xl shadow-lg mb-10" 
             src="image/<?= htmlspecialchars($kegiatan['gambar']) ?>" 
             alt="<?= htmlspecialchars($kegiatan['judul']) ?>">

        <div class="rounded-r-lg">
            <p class="text-lg leading-relaxed">
                <?= htmlspecialchars($kegiatan['deskripsi_singkat']) ?>
            </p>
        </div>
        <div class="article-content">
            <p class="text-lg leading-relaxed">
            <?= nl2br(htmlspecialchars($kegiatan['deskripsi'])) ?>
            </p>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-200">
            <a href="kegiatan.php" class="inline-block bg-gray-200 text-gray-800 font-semibold py-2 px-6 rounded-lg hover:bg-gray-300 transition-colors">
                &larr; Kembali
            </a>
        </div>
        
    </div>
</div>

<?php 
// Panggil footer jika ada
// include 'footer.php'; 
?>
</body>
</html>