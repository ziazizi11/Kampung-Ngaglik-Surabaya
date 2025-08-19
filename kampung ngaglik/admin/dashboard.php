<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
// 1. Panggil header. Ini akan memuat sidebar dan semua gaya dasar.
include 'header.php'; 
include '../koneksi/koneksi.php';

// Fungsi untuk mendapatkan hitungan data tetap sama
function getTotalCount($conn, $table) {
    $query = "SELECT COUNT(id) AS total FROM $table";
    $result = mysqli_query($conn, $query);
    return $result ? mysqli_fetch_assoc($result)['total'] : 0;
}

// Mengambil total data dari setiap tabel
$total_kegiatan = getTotalCount($conn, 'berita'); // Menggunakan tabel 'berita' untuk kegiatan
$total_umkm = getTotalCount($conn, 'umkm');
$total_agenda = getTotalCount($conn, 'kegiatan'); // Menggunakan tabel 'kegiatan' untuk agenda

// Dummy data pengunjung sudah dihapus

// [PERBAIKAN QUERY DI SINI]
// Query untuk mengambil 5 konten terbaru dari berbagai tabel
$query_konten = "
    (SELECT 
        id, 
        judul, 
        'Kegiatan' AS kategori, 
        created_at AS tanggal 
    FROM berita)
    UNION ALL
    (SELECT 
        id, 
        nama_produk AS judul, 
        'UMKM' AS kategori, 
        -- DIASUMSIKAN TABEL UMKM TIDAK PUNYA `created_at`. JIKA ADA, GANTI `NULL` DENGAN NAMA KOLOMNYA
        NULL AS tanggal 
    FROM umkm)
    UNION ALL
    (SELECT 
        id, 
        nama_kegiatan AS judul, 
        'Agenda' AS kategori, 
        waktu_kegiatan AS tanggal 
    FROM kegiatan)
    ORDER BY tanggal DESC
    LIMIT 5
";
$konten_terbaru = mysqli_query($conn, $query_konten);

// Cek jika query gagal
if (!$konten_terbaru) {
    // Tampilkan pesan error MySQL untuk debugging
    die("Error pada query konten terbaru: " . mysqli_error($conn));
}
?>

<div class="header-title mb-8">
    <h1 class="text-3xl font-bold text-slate-800">
        Selamat Datang, <?= isset($_SESSION['admin_name']) ? htmlspecialchars($_SESSION['admin_name']) : 'Admin'; ?>!
    </h1>
    <p class="text-slate-500 mt-1">Kelola konten Kampung Ngaglik dengan mudah.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8"> <div class="card bg-white p-6 rounded-xl shadow-md flex items-center space-x-4 transition hover:shadow-lg hover:-translate-y-1">
        <div class="icon bg-blue-100 text-blue-600 h-14 w-14 rounded-full flex items-center justify-center">
            <i class="fas fa-newspaper text-2xl"></i>
        </div>
        <div>
            <p class="text-sm text-slate-500 font-medium">Total Kegiatan</p>
            <p class="text-3xl font-bold text-slate-800"><?= $total_kegiatan ?></p>
        </div>
    </div>
    <div class="card bg-white p-6 rounded-xl shadow-md flex items-center space-x-4 transition hover:shadow-lg hover:-translate-y-1">
        <div class="icon bg-emerald-100 text-emerald-600 h-14 w-14 rounded-full flex items-center justify-center">
            <i class="fas fa-store text-2xl"></i>
        </div>
        <div>
            <p class="text-sm text-slate-500 font-medium">Total UMKM</p>
            <p class="text-3xl font-bold text-slate-800"><?= $total_umkm ?></p>
        </div>
    </div>
    <div class="card bg-white p-6 rounded-xl shadow-md flex items-center space-x-4 transition hover:shadow-lg hover:-translate-y-1">
        <div class="icon bg-amber-100 text-amber-600 h-14 w-14 rounded-full flex items-center justify-center">
            <i class="fas fa-calendar-alt text-2xl"></i>
        </div>
        <div>
            <p class="text-sm text-slate-500 font-medium">Total Agenda</p>
            <p class="text-3xl font-bold text-slate-800"><?= $total_agenda ?></p>
        </div>
    </div>
    </div>

<div class="bg-white p-6 sm:p-8 rounded-xl shadow-md">
    <h3 class="text-xl font-bold text-slate-800 mb-6">Aktivitas Konten Terbaru</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="p-4 font-semibold text-left text-slate-600 rounded-l-lg">Judul</th>
                    <th class="p-4 font-semibold text-left text-slate-600">Kategori</th>
                    <th class="p-4 font-semibold text-left text-slate-600">Tanggal</th>
                    <th class="p-4 font-semibold text-center text-slate-600 rounded-r-lg">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($konten_terbaru && mysqli_num_rows($konten_terbaru) > 0) : ?>
                    <?php while ($row = mysqli_fetch_assoc($konten_terbaru)) : ?>
                        <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50">
                            <td class="p-4 text-slate-800 font-medium"><?= htmlspecialchars($row['judul']) ?></td>
                            <td class="p-4 text-slate-500"><?= htmlspecialchars($row['kategori']) ?></td>
                            <td class="p-4 text-slate-500"><?= $row['tanggal'] ? date("d M Y", strtotime($row['tanggal'])) : 'Tidak ada tanggal' ?></td>
                            <td class="p-4 text-center">
                                <?php
                                    $status_class = 'status-' . strtolower($row['kategori']);
                                    echo "<span class='status-pill {$status_class}'>" . htmlspecialchars($row['kategori']) . "</span>";
                                ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center p-8 text-slate-500">Belum ada aktivitas konten untuk ditampilkan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
// Konten diakhiri sebelum baris ini
?>
</main>
</div>
</body>
</html>