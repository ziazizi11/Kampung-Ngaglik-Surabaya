<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Pastikan ini mengarah ke login.php yang benar
    exit();
}

// Menggunakan path relatif yang benar dari 'admin/'
include '../koneksi/koneksi.php'; // Naik satu level ke root proyek, lalu ke koneksi
include 'header.php'; // header.php ada di folder yang sama (admin/)

// --- Bagian Proses PHP: Upload Berita (DIPINDAHKAN DARI FILE SEBELUMNYA) ---

if (isset($_POST['submit'])) { // Ganti 'submit' menjadi nama tombol submit form Anda
    $nama = trim($_POST['judul']); // Menggunakan 'judul' sesuai form
    $deskripsi_singkat = trim($_POST['deskripsi_singkat']);
    $deskripsi_lengkap = trim($_POST['deskripsi']); // Menggunakan 'deskripsi' sesuai form

    if (empty($nama) || empty($deskripsi_singkat) || empty($deskripsi_lengkap) || !isset($_FILES['gambar']) || $_FILES['gambar']['error'] === UPLOAD_ERR_NO_FILE) {
        $_SESSION['error'] = "Semua field harus diisi, termasuk gambar.";
        header("Location: tambah_berita.php"); // Redirect kembali ke halaman ini jika ada error
        exit();
    }

    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp']; // Tambahkan webp jika diizinkan
    $max_size = 5 * 1024 * 1024; // 5MB
    $file_type = $_FILES['gambar']['type'];
    $file_size = $_FILES['gambar']['size'];
    $file_tmp = $_FILES['gambar']['tmp_name'];
    $file_name = $_FILES['gambar']['name'];

    if (!in_array($file_type, $allowed_types)) {
        $_SESSION['error'] = "Format gambar tidak valid. Gunakan JPG, PNG, GIF, atau WEBP.";
        header("Location: tambah_berita.php");
        exit();
    }

    if ($file_size > $max_size) {
        $_SESSION['error'] = "Ukuran gambar terlalu besar. Maksimum 5MB.";
        header("Location: tambah_berita.php");
        exit();
    }

    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $gambar = 'berita_' . time() . '.' . $extension;
    $path = "../image/" . $gambar; // Path relatif dari admin/ ke image/

    // Pastikan folder "../image/" memiliki izin tulis
    if (!move_uploaded_file($file_tmp, $path)) {
        $_SESSION['error'] = "Gagal mengunggah gambar. Pastikan folder 'image' ada dan memiliki izin tulis.";
        header("Location: tambah_berita.php");
        exit();
    }

    // Query INSERT ke tabel 'berita'
    $query = "INSERT INTO berita (gambar, judul, deskripsi_singkat, deskripsi, created_at) VALUES (?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $gambar, $nama, $deskripsi_singkat, $deskripsi_lengkap);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Berita berhasil diunggah.";
        header("Location: berita_admin.php"); // Redirect ke halaman daftar berita setelah sukses
    } else {
        $_SESSION['error'] = "Gagal mengunggah berita: " . mysqli_error($conn);
        if (file_exists($path)) { // Hapus gambar jika insert DB gagal
            unlink($path);
        }
        header("Location: tambah_berita.php"); // Redirect kembali ke form jika ada error DB
    }
    exit(); // Penting untuk exit() setelah header()
}

// --- Akhir Bagian Proses PHP ---
?>

<div class="header-title mb-8">
    <h1 class="text-3xl font-bold text-slate-800">
        Tambah Kegiatan Baru
    </h1>
    <p class="text-slate-500 mt-1">Isi formulir di bawah untuk menambahkan informasi kegiatan baru.</p>
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

<div class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 border-b-2 border-slate-200 pb-3">📝 Formulir Tambah Kegiatan</h2>
    <form method="POST" enctype="multipart/form-data" action=""> <input type="hidden" name="submit" value="1"> <div class="mb-4">
            <label for="judul" class="block text-slate-700 text-sm font-bold mb-2">Judul</label>
            <input type="text" name="judul" id="judul" placeholder="Masukkan judul berita/kegiatan" required maxlength="255"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
        </div>

        <div class="mb-4">
            <label for="deskripsi_singkat" class="block text-slate-700 text-sm font-bold mb-2">Deskripsi Singkat</label>
            <textarea name="deskripsi_singkat" id="deskripsi_singkat" rows="3" placeholder="Masukkan deskripsi singkat (maksimal 2-3 kalimat)" required
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out"></textarea>
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block text-slate-700 text-sm font-bold mb-2">Deskripsi Lengkap</label>
            <textarea name="deskripsi" id="deskripsi" rows="6" placeholder="Masukkan deskripsi lengkap berita/kegiatan" required
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out"></textarea>
        </div>

        <div class="mb-6">
            <label for="gambar" class="block text-slate-700 text-sm font-bold mb-2">Gambar</label>
            <input type="file" name="gambar" id="gambar" accept="image/jpeg,image/png,image/gif,image/webp" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            <p class="text-sm text-slate-500 mt-2">Format: JPG, PNG, GIF, WEBP. Maksimum 5MB.</p>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" name="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                Upload Kegiatan
            </button>
            <a href="uploud_berita.php" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
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