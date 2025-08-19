<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Pastikan ini mengarah ke login.php yang benar
    exit();
}

// Menggunakan path relatif yang benar dari 'admin/'
include '../koneksi/koneksi.php'; // Naik satu level ke root proyek, lalu ke koneksi
include 'header.php'; // header.php ada di folder yang sama (admin/)

// --- Bagian Proses PHP: Hapus Berita (TIDAK BERUBAH LOGIKA, HANYA PATH) ---

// Hapus Berita
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $query = "SELECT gambar FROM berita WHERE id = ?"; // Perhatikan: tabel 'berita'
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // Path gambar perlu disesuaikan. Asumsi gambar berita ada di 'image/' di root proyek.
    $imagePath = "../image/" . $row['gambar']; // Path relatif dari 'admin/' ke 'image/'
    if ($row && !empty($row['gambar']) && file_exists($imagePath)) {
        unlink($imagePath);
    }

    $query = "DELETE FROM berita WHERE id = ?"; // Perhatikan: tabel 'berita'
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $_SESSION['success'] = "Berita berhasil dihapus.";
    header("Location: berita_admin.php"); // Redirect kembali ke halaman ini
    exit();
}

// --- Akhir Bagian Proses PHP untuk Hapus ---
?>

<div class="header-title mb-8">
    <h1 class="text-3xl font-bold text-slate-800">
        Kelola Kegiatan
    </h1>
    <p class="text-slate-500 mt-1">Tambahkan, edit, atau hapus informasi kegiatan.</p>
</div>

<?php if (isset($_SESSION['error'])): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></span>
    </div>
<?php endif; ?>
<?php if (isset($_SESSION['success'])): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></span>
    </div>
<?php endif; ?>

<div class="mb-8 text-right">
    <a href="tambah_berita.php" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
        <i class="fas fa-plus mr-2"></i> Tambah Kegiatan Baru
    </a>
</div>

<div class="bg-white p-6 sm:p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 border-b-2 border-slate-200 pb-3">🗂️ Daftar Kegiatan</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Nama Kegiatan
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider w-1/4">
                        Deskripsi Singkat
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider w-1/4">
                        Deskripsi Lengkap
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Gambar
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Waktu Upload
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = mysqli_query($conn, "SELECT * FROM berita ORDER BY id DESC"); // Perhatikan: tabel 'berita'
                if (mysqli_num_rows($q) > 0) {
                    while ($data = mysqli_fetch_assoc($q)) {
                ?>
                        <tr>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <p class="text-slate-900 whitespace-no-wrap"><?= htmlspecialchars($data['judul']) ?></p>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <div class="max-h-24 overflow-y-auto p-2 border border-slate-200 rounded-md bg-slate-50 text-slate-700">
                                    <?= nl2br(htmlspecialchars($data['deskripsi_singkat'])) ?>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <div class="max-h-24 overflow-y-auto p-2 border border-slate-200 rounded-md bg-slate-50 text-slate-700">
                                    <?= nl2br(htmlspecialchars($data['deskripsi'])) ?>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <img src="../image/<?= htmlspecialchars($data['gambar']) ?>" alt="Gambar Berita" class="w-20 h-20 object-cover rounded-md shadow-sm border border-slate-200">
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <p class="text-slate-900 whitespace-no-wrap"><?= date("d M Y H:i", strtotime($data['created_at'])) ?></p>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm text-center whitespace-no-wrap">
                                <a href="edit_berita.php?id=<?= $data['id'] ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out mr-2">Edit</a>
                                <a href="berita_admin.php?hapus=<?= $data['id'] ?>" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out" onclick="return confirm('Yakin ingin menghapus berita ini?')">Hapus</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="6" class="px-5 py-5 border-b border-slate-200 bg-white text-center text-sm text-slate-500">Belum ada berita atau kegiatan yang diunggah.</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Catatan: Fungsi JavaScript toggleDeskripsi tidak lagi diperlukan di halaman ini
// karena deskripsi singkat dan lengkap ditampilkan di kolom terpisah.
// Jadi, Anda bisa menghapus blok <script> dari sini.
?>
</main>
</div>
</body>
</html>