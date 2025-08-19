<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Pastikan ini mengarah ke login.php yang benar
    exit();
}

// Jalur yang benar untuk header.php (ada di folder yang sama dengan edit_beranda.php)
include 'header.php';
// Jalur yang benar untuk koneksi.php (naik satu level dari 'admin' ke 'kampung ngaglik', lalu masuk ke 'koneksi')
include '../koneksi/koneksi.php'; // <--- PERBAIKAN DI SINI (dari '../../' menjadi '../')

// Get content ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch existing content
$query = "SELECT * FROM beranda WHERE id = ?";
$stmt = mysqli_prepare($conn, $query); // $conn sekarang seharusnya sudah terdefinisi
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$content = mysqli_fetch_assoc($result);

if (!$content) {
    // Jika konten tidak ditemukan, redirect kembali ke halaman daftar beranda
    header("Location: crud/beranda_admin.php"); // <--- PERBAIKAN DI SINI (jalur ke beranda_admin.php)
    exit();
}
?>

<div class="header-title mb-8">
    <h1 class="text-3xl font-bold text-slate-800">
        Edit Konten Beranda
    </h1>
    <p class="text-slate-500 mt-1">Ubah informasi konten beranda yang ada.</p>
</div>

<div class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 border-b-2 border-slate-200 pb-3">✏️ Formulir Edit Konten</h2>
    <form action="proses/proses_edit_beranda.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($content['id']) ?>">

        <div class="mb-4">
            <label for="judul" class="block text-slate-700 text-sm font-bold mb-2">Judul</label>
            <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($content['judul']) ?>" placeholder="Masukkan judul konten" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block text-slate-700 text-sm font-bold mb-2">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="6" placeholder="Tuliskan deskripsi konten" required
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out"><?= htmlspecialchars($content['deskripsi']) ?></textarea>
        </div>

        <div class="mb-6">
            <label for="gambar" class="block text-slate-700 text-sm font-bold mb-2">Gambar (kosongkan jika tidak ingin mengubah)</label>
            <input type="file" id="gambar" name="gambar" accept="image/*"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

            <p class="text-sm text-slate-500 mt-2">Gambar saat ini:</p>
            <img src="../image/<?= htmlspecialchars($content['gambar']) ?>" alt="Gambar Saat Ini" class="w-32 h-32 object-cover rounded-md shadow-sm border border-slate-200 mt-2">
            <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($content['gambar']) ?>">
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                Update Konten
            </button>
            <a href="uploud_beranda.php" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                Kembali
            </a>
        </div>
    </form>
</div>

<?php
// Konten diakhiri sebelum baris ini.
// Pastikan </body> dan </html> ditutup oleh header.php atau footer.php jika ada.
?>
</main>
</div>
</body>
</html>