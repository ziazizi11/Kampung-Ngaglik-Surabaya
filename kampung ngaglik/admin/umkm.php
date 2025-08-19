<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Pastikan ini mengarah ke login.php yang benar
    exit();
}

// Menggunakan path relatif yang benar dari 'admin/'
include '../koneksi/koneksi.php'; // Naik satu level ke root proyek, lalu ke koneksi
include 'header.php'; // header.php ada di folder yang sama (admin/)

// --- Bagian Proses PHP: Hapus UMKM (jika ada, dipindahkan ke sini atau proses terpisah) ---
// Jika proses hapus_umkm.php sudah menangani redirect, blok ini mungkin tidak diperlukan
// Namun, jika Anda ingin proses hapus langsung di halaman ini, Anda bisa masukkan di sini.
// Untuk konsistensi, saya akan mengasumsikan proses hapus tetap di 'proses/proses_hapus_umkm.php'

// Contoh: Jika ada pesan sukses/error dari proses_hapus_umkm.php atau proses_upload_umkm.php
if (isset($_SESSION['error'])): ?>
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

<div class="header-title mb-8">
    <h1 class="text-3xl font-bold text-slate-800">
        Kelola Data UMKM
    </h1>
    <p class="text-slate-500 mt-1">Tambahkan, edit, atau hapus data UMKM.</p>
</div>

<div class="mb-8 text-right">
    <a href="tambah_umkm.php" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
        <i class="fas fa-plus mr-2"></i> Tambah Data UMKM Baru
    </a>
</div>

<div class="bg-white p-6 sm:p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 border-b-2 border-slate-200 pb-3">🏪 Daftar UMKM</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Gambar
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Nama Produk
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Alamat
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Pemilik
                    </th>
                    <th class="px-5 py-3 border-b-2 border-slate-200 bg-slate-100 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM umkm ORDER BY id DESC"); // Urutkan berdasarkan ID terbaru
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <img src="../image/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_produk']) ?>" class="w-20 h-20 object-cover rounded-md shadow-sm border border-slate-200">
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <p class="text-slate-900 whitespace-no-wrap"><?= htmlspecialchars($row['nama_produk']) ?></p>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <p class="text-slate-900 whitespace-no-wrap"><?= htmlspecialchars($row['alamat']) ?></p>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <p class="text-slate-900 whitespace-no-wrap"><?= htmlspecialchars($row['pemilik']) ?></p>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm text-center whitespace-no-wrap">
                                <a href="edit_umkm.php?id=<?= $row['id'] ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out mr-2">Edit</a>
                                <a href="proses/proses_hapus_umkm.php?id=<?= $row['id'] ?>" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="5" class="px-5 py-5 border-b border-slate-200 bg-white text-center text-sm text-slate-500">Belum ada data UMKM yang diunggah.</td>
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