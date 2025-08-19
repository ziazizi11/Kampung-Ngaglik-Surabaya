<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Pastikan ini mengarah ke login.php yang benar
    exit();
}

// Menggunakan path relatif yang benar dari 'admin/'
include '../koneksi/koneksi.php'; // Naik satu level ke root proyek, lalu ke koneksi
include 'header.php'; // header.php ada di folder yang sama (admin/)

// --- Bagian Proses PHP: Hapus Agenda (TIDAK BERUBAH LOGIKA) ---

// Hapus Agenda (menggunakan tabel 'kegiatan')
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $query = "SELECT gambar FROM kegiatan WHERE id = ?"; // Tabel 'kegiatan'
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // Path gambar perlu disesuaikan karena skrip ada di 'admin/'
    // Dan gambar disimpan di 'admin/proses/image/'
    $imagePath = "proses/image/" . $row['gambar']; // Ini path relatif dari file ini
    if ($row && !empty($row['gambar']) && file_exists($imagePath)) {
        unlink($imagePath);
    }

    $query = "DELETE FROM kegiatan WHERE id = ?"; // Tabel 'kegiatan'
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $_SESSION['success'] = "Agenda berhasil dihapus.";
    header("Location: uploud_agenda.php"); // Redirect kembali ke halaman ini
    exit();
}

// --- Akhir Bagian Proses PHP untuk Hapus ---
?>

<div class="header-title mb-8">
    <h1 class="text-3xl font-bold text-slate-800">
        Kelola Agenda
    </h1>
    <p class="text-slate-500 mt-1">Tambahkan, edit, atau hapus data agenda yang akan ditampilkan.</p>
</div>

<?php
// Tampilkan pesan error jika ada
if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline"><?php echo htmlspecialchars($_SESSION['error']); ?></span>
    </div>
<?php
    unset($_SESSION['error']); // Hapus pesan error dari sesi setelah ditampilkan
}
?>

<?php
// Tampilkan pesan sukses jika ada
if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline"><?php echo htmlspecialchars($_SESSION['success']); ?></span>
    </div>
<?php
    unset($_SESSION['success']); // Hapus pesan sukses dari sesi setelah ditampilkan
}
?>

<div class="mb-8 text-right">
    <a href="tambah_agenda.php" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
        <i class="fas fa-plus mr-2"></i> Tambah Agenda Baru
    </a>
</div>

<div class="bg-white p-6 sm:p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 border-b-2 border-slate-200 pb-3">📋 Daftar Agenda</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Gambar
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Nama Agenda
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Waktu
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Tempat
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query mengambil data dari tabel 'kegiatan'
                $kegiatan = $conn->query("SELECT * FROM kegiatan ORDER BY waktu_kegiatan DESC");
                if ($kegiatan->num_rows > 0) {
                    while ($row = $kegiatan->fetch_assoc()) {
                ?>
                        <tr>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <img src="proses/image/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_kegiatan']) ?>" class="w-20 h-20 object-cover rounded-md shadow-sm border border-slate-200">
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <p class="text-slate-900 whitespace-no-wrap"><?= htmlspecialchars($row['nama_kegiatan']) ?></p>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <p class="text-slate-900 whitespace-no-wrap"><?= date("d M Y", strtotime($row['waktu_kegiatan'])) ?></p>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <p class="text-slate-900 whitespace-no-wrap"><?= htmlspecialchars($row['tempat_kegiatan']) ?></p>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    <?php
                                        // Sesuaikan kelas Tailwind dengan status 'Terlaksana'/'Belum Terlaksana'
                                        if($row['status'] == 'Terlaksana') echo 'bg-green-100 text-green-800';
                                        else if($row['status'] == 'Belum Terlaksana') echo 'bg-amber-100 text-amber-800'; // Menggunakan amber untuk Belum Terlaksana
                                        else echo 'bg-gray-100 text-gray-800'; // Fallback for old/unknown status
                                    ?>">
                                    <?= htmlspecialchars($row['status']) ?>
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm text-center whitespace-no-wrap">
                                <a href="edit_kegiatan.php?id=<?= $row['id'] ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out mr-2">Edit</a>
                                <a href="uploud_agenda.php?hapus=<?= $row['id'] ?>" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out" onclick="return confirm('Yakin ingin menghapus agenda ini?')">Hapus</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="6" class="px-5 py-5 border-b border-slate-200 bg-white text-center text-sm text-slate-500">Belum ada agenda yang diunggah.</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Pastikan </body> dan </html> ditutup oleh header.php atau footer.php jika ada.
?>
</main>
</div>
</body>
</html>