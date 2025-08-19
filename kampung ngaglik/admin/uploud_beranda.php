<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include 'header.php'; // Ini akan memuat sidebar dan semua gaya dasar (termasuk Tailwind CSS)
include '../koneksi/koneksi.php';

// ... (Bagian PHP untuk hapus berita) ...
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $query = "SELECT gambar FROM berita WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $imagePath = "../image/" . $row['gambar'];
    if ($row && !empty($row['gambar']) && file_exists($imagePath)) {
        unlink($imagePath);
    }

    $query = "DELETE FROM berita WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $_SESSION['success'] = "Berita berhasil dihapus.";
    header("Location: berita_admin.php");
    exit();
}
?>

<div class="header-title mb-8">
    <h1 class="text-3xl font-bold text-slate-800">
        Kelola Konten Beranda
    </h1>
    <p class="text-slate-500 mt-1">Tambahkan, edit, atau hapus konten yang tampil di halaman beranda.</p>
</div>

<?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></span>
    </div>
<?php endif; ?>
<?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></span>
    </div>
<?php endif; ?>

<div class="mb-8 text-right">
    <a href="tambah_beranda.php" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
        <i class="fas fa-plus mr-2"></i> Tambah Konten Beranda Baru
    </a>
</div>

<div class="bg-white p-6 sm:p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 border-b-2 border-slate-200 pb-3">🗂️ Daftar Konten Beranda</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider w-1/5">
                        Judul
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider w-2/5">
                        Deskripsi
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Gambar
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Waktu
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $beranda = mysqli_query($conn, "SELECT * FROM beranda ORDER BY id DESC");
                if (mysqli_num_rows($beranda) > 0) {
                    while ($row = mysqli_fetch_assoc($beranda)) {
                        $id = $row['id'];
                        $deskripsi = nl2br(htmlspecialchars($row['deskripsi']));
                ?>
                        <tr>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <p class="text-slate-900 whitespace-no-wrap"><?= htmlspecialchars($row['judul']) ?></p>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <div class="deskripsi-penuh max-h-32 overflow-y-auto p-2 border border-slate-200 rounded-md bg-slate-50 text-slate-700">
                                    <?= $deskripsi ?>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <img src="../image/<?= htmlspecialchars($row['gambar']) ?>" alt="Gambar Konten" class="w-20 h-20 object-cover rounded-md shadow-sm border border-slate-200">
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <p class="text-slate-900 whitespace-no-wrap"><?= date("d M Y H:i", strtotime($row['created_at'])) ?></p>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm text-center whitespace-no-wrap">
                                <a href="edit_beranda.php?id=<?= $id ?>"
                                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded
                                          transition duration-150 ease-in-out mr-2"> Edit
                                </a>
                                <a href="berita_admin.php?hapus=<?= $id ?>"
                                   class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded
                                          transition duration-150 ease-in-out"
                                   onclick="return confirm('Yakin ingin menghapus berita ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="5" class="px-5 py-5 border-b border-slate-200 bg-white text-center text-sm text-slate-500">Belum ada konten beranda yang diunggah.</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Konten diakhiri sebelum baris ini.
// Pastikan </body> dan </html> ditutup oleh header.php atau footer.php jika ada.
?>
</main>
</div>
</body>
</html>