<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Pastikan ini mengarah ke login.php yang benar
    exit();
}

// Menggunakan path relatif yang benar dari 'admin/'
include '../koneksi/koneksi.php'; // Naik satu level ke root proyek, lalu ke koneksi
include 'header.php'; // header.php ada di folder yang sama (admin/)

// Get content ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch existing content
$query = "SELECT * FROM kegiatan WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$content = mysqli_fetch_assoc($result);

if (!$content) {
    $_SESSION['error'] = "Kegiatan tidak ditemukan.";
    header("Location: uploud_agenda.php"); // Redirect ke halaman daftar agenda/kegiatan
    exit();
}
?>

<div class="header-title mb-8">
    <h1 class="text-3xl font-bold text-slate-800">
        Edit Kegiatan
    </h1>
    <p class="text-slate-500 mt-1">Ubah informasi kegiatan yang ada.</p>
</div>

<div class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 border-b-2 border-slate-200 pb-3">✏️ Formulir Edit Kegiatan</h2>
    <form action="proses/proses_edit_kegiatan.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($content['id']) ?>">
        
        <div class="mb-4">
            <label for="nama_kegiatan" class="block text-slate-700 text-sm font-bold mb-2">Nama Kegiatan</label>
            <input type="text" id="nama_kegiatan" name="nama_kegiatan" value="<?= htmlspecialchars($content['nama_kegiatan']) ?>" placeholder="Masukkan nama kegiatan" required maxlength="255"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
        </div>
        
        <div class="mb-4">
            <label for="waktu_kegiatan" class="block text-slate-700 text-sm font-bold mb-2">Waktu Kegiatan</label>
            <input type="date" id="waktu_kegiatan" name="waktu_kegiatan" value="<?= htmlspecialchars($content['waktu_kegiatan']) ?>" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
        </div>
        
        <div class="mb-4">
            <label for="tempat_kegiatan" class="block text-slate-700 text-sm font-bold mb-2">Tempat Kegiatan</label>
            <input type="text" id="tempat_kegiatan" name="tempat_kegiatan" value="<?= htmlspecialchars($content['tempat_kegiatan']) ?>" placeholder="Masukkan tempat kegiatan" required maxlength="255"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
        </div>

        <div class="mb-4">
            <label for="status" class="block text-slate-700 text-sm font-bold mb-2">Status Kegiatan</label>
            <select id="status" name="status" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
                <option value="Aktif" <?= $content['status'] === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="Selesai" <?= $content['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                <option value="Non-Aktif" <?= $content['status'] === 'Non-Aktif' ? 'selected' : '' ?>>Non-Aktif</option>
            </select>
        </div>
        
        <div class="mb-6">
            <label for="gambar" class="block text-slate-700 text-sm font-bold mb-2">Gambar Kegiatan (kosongkan jika tidak ingin mengubah)</label>
            <input type="file" id="gambar" name="gambar" accept="image/jpeg,image/png,image/gif,image/webp"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            <p class="text-sm text-slate-500 mt-2">Format: JPG, PNG, GIF, WEBP. Maksimum 5MB.</p>

            <p class="text-sm text-slate-500 mt-2">Gambar saat ini:</p>
            <img src="proses/image/<?= htmlspecialchars($content['gambar']) ?>" alt="Gambar Kegiatan Saat Ini" class="w-32 h-32 object-cover rounded-md shadow-sm border border-slate-200 mt-2">
            <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($content['gambar']) ?>">
        </div>
        
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                Update Kegiatan
            </button>
            <a href="uploud_kegiatan.php" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                Kembali
            </a>
        </div>
    </form>
</div>

<?php
// Pastikan </body> dan </html> ditutup oleh header.php atau footer.php jika ada.
?>
</main>
</div>
</body>
</html>