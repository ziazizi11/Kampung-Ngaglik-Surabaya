<?php
// PASTIKAN SEMUA LOGIKA PHP TERMASUK session_start() DAN REDIRECT ADA DI PALING ATAS FILE
// SEBELUM include FILE LAIN YANG MUNGKIN MEMILIKI OUTPUT HTML ATAU SPASI.

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Pastikan ini mengarah ke login.php yang benar
    exit();
}

// Menggunakan path relatif yang benar dari 'admin/'
// Include koneksi harus sebelum logika yang menggunakan $conn
include '../koneksi/koneksi.php';

// --- Bagian Proses PHP: Upload UMKM ---
// Ini akan diproses HANYA JIKA ada POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = trim($_POST['nama_produk']);
    $alamat = trim($_POST['alamat']);
    $pemilik = trim($_POST['pemilik']);

    // Validasi input
    if (empty($nama_produk) || empty($alamat) || empty($pemilik) || !isset($_FILES['gambar']) || $_FILES['gambar']['error'] === UPLOAD_ERR_NO_FILE) {
        $_SESSION['error'] = "Semua field harus diisi, termasuk gambar.";
        header("Location: tambah_umkm.php"); // Redirect kembali ke halaman ini
        exit();
    }

    $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
    $max_size = 5 * 1024 * 1024; // 5MB
    $file_type = $_FILES['gambar']['type'];
    $file_size = $_FILES['gambar']['size'];
    $file_tmp = $_FILES['gambar']['tmp_name'];
    $file_name = $_FILES['gambar']['name'];

    if (!in_array($file_type, $allowed_types)) {
        $_SESSION['error'] = "Format gambar tidak valid. Gunakan JPG, PNG, atau WEBP.";
        header("Location: tambah_umkm.php");
        exit();
    }

    if ($file_size > $max_size) {
        $_SESSION['error'] = "Ukuran gambar terlalu besar. Maksimum 5MB.";
        header("Location: tambah_umkm.php");
        exit();
    }

    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $gambar = 'umkm_' . time() . '.' . $extension;
    $path = "../image/" . $gambar; // Path relatif dari admin/ ke image/

    // Pastikan folder "../image/" memiliki izin tulis
    if (!move_uploaded_file($file_tmp, $path)) {
        $_SESSION['error'] = "Gagal mengunggah gambar. Pastikan folder 'image' ada dan memiliki izin tulis.";
        header("Location: tambah_umkm.php");
        exit();
    }

    // Query INSERT ke tabel 'umkm'
    $query = "INSERT INTO umkm (nama_produk, alamat, pemilik, gambar) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $nama_produk, $alamat, $pemilik, $gambar);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Data UMKM berhasil ditambahkan.";
        header("Location: umkm.php"); // Pastikan ini mengarah ke data_umkm.php
    } else {
        $_SESSION['error'] = "Gagal menambahkan data UMKM: " . mysqli_error($conn);
        if (file_exists($path)) { // Hapus gambar jika insert DB gagal
            unlink($path);
        }
        header("Location: tambah_umkm.php"); // Redirect kembali ke form jika ada error DB
    }
    exit(); // PENTING: Selalu exit() setelah header()
}

// Include header.php setelah semua logika PHP yang mungkin melakukan redirect
// Ini memastikan header.php tidak mencetak output sebelum waktunya.
include 'header.php';
?>

<div class="header-title mb-8">
    <h1 class="text-3xl font-bold text-slate-800">
        Tambah Data UMKM Baru
    </h1>
    <p class="text-slate-500 mt-1">Isi formulir di bawah untuk menambahkan data UMKM baru.</p>
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

<div class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 border-b-2 border-slate-200 pb-3">📝 Formulir Tambah UMKM</h2>
    <form method="POST" enctype="multipart/form-data" action="">
        <input type="hidden" name="submit_umkm_form" value="1"> <div class="mb-4">
            <label for="nama_produk" class="block text-slate-700 text-sm font-bold mb-2">Nama Produk</label>
            <input type="text" name="nama_produk" id="nama_produk" placeholder="Masukkan nama produk" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
        </div>

        <div class="mb-4">
            <label for="alamat" class="block text-slate-700 text-sm font-bold mb-2">Alamat</label>
            <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat UMKM" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
        </div>

        <div class="mb-4">
            <label for="pemilik" class="block text-slate-700 text-sm font-bold mb-2">Pemilik</label>
            <input type="text" name="pemilik" id="pemilik" placeholder="Masukkan nama pemilik" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
        </div>

        <div class="mb-6">
            <label for="gambar" class="block text-slate-700 text-sm font-bold mb-2">Gambar Produk</label>
            <input type="file" name="gambar" id="gambar" accept="image/jpeg,image/png,image/webp" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            <p class="text-sm text-slate-500 mt-2">Format: JPG, PNG, WEBP. Maksimum 5MB.</p>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                Simpan Data UMKM
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