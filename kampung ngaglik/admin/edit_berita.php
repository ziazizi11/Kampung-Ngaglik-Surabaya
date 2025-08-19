<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Pastikan ini mengarah ke login.php yang benar
    exit();
}

// Menggunakan path relatif yang benar dari 'admin/'
include '../koneksi/koneksi.php'; // Naik satu level ke root proyek, lalu ke koneksi
include 'header.php'; // header.php ada di folder yang sama (admin/)

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect jika ID tidak valid, berikan pesan error
    $_SESSION['error'] = "ID berita tidak valid.";
    header("Location: berita_admin.php"); // Arahkan ke halaman daftar berita
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM berita WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    // Redirect jika data tidak ditemukan, berikan pesan error
    $_SESSION['error'] = "Data berita tidak ditemukan.";
    header("Location: berita_admin.php"); // Arahkan ke halaman daftar berita
    exit();
}
?>

<div class="header-title mb-8">
    <h1 class="text-3xl font-bold text-slate-800">
        Edit Berita & Kegiatan
    </h1>
    <p class="text-slate-500 mt-1">Ubah informasi berita atau kegiatan yang ada.</p>
</div>

<div class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 border-b-2 border-slate-200 pb-3">✏️ Formulir Edit Berita</h2>
    <form action="proses/proses_update_berita.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">
        
        <div class="mb-4">
            <label for="judul" class="block text-slate-700 text-sm font-bold mb-2">Judul</label>
            <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" placeholder="Masukkan judul berita" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
        </div>
        
        <div class="mb-4">
            <label for="deskripsi_singkat" class="block text-slate-700 text-sm font-bold mb-2">Deskripsi Singkat</label>
            <textarea id="deskripsi_singkat" name="deskripsi_singkat" rows="3" placeholder="Masukkan deskripsi singkat (maksimal 2-3 kalimat)" required
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out"><?= htmlspecialchars($data['deskripsi_singkat']) ?></textarea>
        </div>
        
        <div class="mb-4">
            <label for="deskripsi" class="block text-slate-700 text-sm font-bold mb-2">Deskripsi Lengkap</label>
            <textarea id="deskripsi" name="deskripsi" rows="6" placeholder="Masukkan deskripsi lengkap berita (boleh banyak paragraf)" required
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
        </div>
        
        <div class="mb-6">
            <label for="gambar" class="block text-slate-700 text-sm font-bold mb-2">Gambar (kosongkan jika tidak ingin mengubah)</label>
            <input type="file" id="gambar" name="gambar" accept="image/*"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            
            <p class="text-sm text-slate-500 mt-2">Gambar saat ini:</p>
            <img src="../image/<?= htmlspecialchars($data['gambar']) ?>" alt="Gambar Saat Ini" class="w-32 h-32 object-cover rounded-md shadow-sm border border-slate-200 mt-2">
            <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($data['gambar']) ?>">
        </div>
        
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                Update Berita
            </button>
            <a href="uploud_berita.php" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
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