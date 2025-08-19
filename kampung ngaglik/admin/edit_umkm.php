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
    $_SESSION['error'] = "ID UMKM tidak valid.";
    header("Location: data_umkm.php"); // Arahkan ke halaman daftar UMKM
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = $conn->query("SELECT * FROM umkm WHERE id = $id");
$data = $query->fetch_assoc();

if (!$data) {
    // Redirect jika data tidak ditemukan, berikan pesan error
    $_SESSION['error'] = "Data UMKM tidak ditemukan.";
    header("Location: data_umkm.php"); // Arahkan ke halaman daftar UMKM
    exit();
}
?>

<div class="header-title mb-8">
    <h1 class="text-3xl font-bold text-slate-800">
        Edit Data UMKM
    </h1>
    <p class="text-slate-500 mt-1">Ubah informasi data UMKM yang ada.</p>
</div>

<div class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 border-b-2 border-slate-200 pb-3">✏️ Formulir Edit UMKM</h2>
    <form action="proses/proses_edit_umkm.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">
        
        <div class="mb-4">
            <label for="nama_produk" class="block text-slate-700 text-sm font-bold mb-2">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk" value="<?= htmlspecialchars($data['nama_produk']) ?>" placeholder="Masukkan nama produk" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
        </div>
        
        <div class="mb-4">
            <label for="alamat" class="block text-slate-700 text-sm font-bold mb-2">Alamat</label>
            <input type="text" id="alamat" name="alamat" value="<?= htmlspecialchars($data['alamat']) ?>" placeholder="Masukkan alamat UMKM" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
        </div>
        
        <div class="mb-4">
            <label for="pemilik" class="block text-slate-700 text-sm font-bold mb-2">Pemilik</label>
            <input type="text" id="pemilik" name="pemilik" value="<?= htmlspecialchars($data['pemilik']) ?>" placeholder="Masukkan nama pemilik" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
        </div>
        
        <div class="mb-6">
            <label for="gambar" class="block text-slate-700 text-sm font-bold mb-2">Gambar Produk (kosongkan jika tidak ingin mengubah)</label>
            <input type="file" id="gambar" name="gambar" accept="image/jpeg,image/png,image/webp"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            
            <p class="text-sm text-slate-500 mt-2">Gambar saat ini:</p>
            <img src="../image/<?= htmlspecialchars($data['gambar']) ?>" alt="Gambar UMKM" class="w-32 h-32 object-cover rounded-md shadow-sm border border-slate-200 mt-2">
            <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($data['gambar']) ?>">
        </div>
        
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                Update Data UMKM
            </button>
            <a href="umkm.php" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
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