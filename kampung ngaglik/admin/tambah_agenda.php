<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Pastikan ini mengarah ke login.php yang benar
    exit();
}

// Menggunakan path relatif yang benar dari 'admin/'
include '../koneksi/koneksi.php'; // Naik satu level ke root proyek, lalu ke koneksi
include 'header.php'; // header.php ada di folder yang sama (admin/)

// --- Bagian Proses PHP: Upload Agenda (DIPINDAHKAN DARI uploud_agenda.php) ---

if (isset($_POST['submit'])) {
    $nama = trim($_POST['nama_kegiatan']); // Kolom di form Anda
    $waktu = $_POST['waktu_kegiatan'];     // Kolom di form Anda
    $tempat = trim($_POST['tempat_kegiatan']); // Kolom di form Anda

    if (empty($nama) || empty($waktu) || empty($tempat) || !isset($_FILES['gambar']) || $_FILES['gambar']['error'] === UPLOAD_ERR_NO_FILE) {
        $_SESSION['error'] = "Semua field harus diisi, termasuk gambar.";
        header("Location: tambah_agenda.php"); // Redirect kembali ke halaman ini jika ada error
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
        header("Location: tambah_agenda.php");
        exit();
    }

    if ($file_size > $max_size) {
        $_SESSION['error'] = "Ukuran gambar terlalu besar. Maksimum 5MB.";
        header("Location: tambah_agenda.php");
        exit();
    }

    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $gambar = 'agenda_' . time() . '.' . $extension; // Sesuaikan nama file gambar
    $path = "proses/image/" . $gambar; // Path relatif dari admin/ ke admin/proses/image/

    // Pastikan folder "proses/image/" memiliki izin tulis
    if (!move_uploaded_file($file_tmp, $path)) {
        $_SESSION['error'] = "Gagal mengunggah gambar. Pastikan folder 'admin/proses/image/' ada dan memiliki izin tulis.";
        header("Location: tambah_agenda.php");
        exit();
    }

    // Query INSERT ke tabel 'kegiatan' (karena agenda dan kegiatan menggunakan tabel yang sama)
    $query = "INSERT INTO kegiatan (gambar, nama_kegiatan, waktu_kegiatan, tempat_kegiatan, status) VALUES (?, ?, ?, ?, 'Aktif')";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $gambar, $nama, $waktu, $tempat);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Agenda berhasil diunggah.";
        header("Location: uploud_agenda.php"); // Redirect ke halaman daftar agenda setelah sukses
    } else {
        $_SESSION['error'] = "Gagal mengunggah agenda: " . mysqli_error($conn);
        if (file_exists($path)) { // Hapus gambar jika insert DB gagal
            unlink($path);
        }
        header("Location: tambah_agenda.php"); // Redirect kembali ke form jika ada error DB
    }
    exit(); // Penting untuk exit() setelah header()
}

// --- Akhir Bagian Proses PHP ---
?>

<div class="header-title mb-8">
    <h1 class="text-3xl font-bold text-slate-800">
        Tambah Agenda Baru
    </h1>
    <p class="text-slate-500 mt-1">Isi formulir di bawah untuk menambahkan agenda baru.</p>
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
    <h2 class="text-2xl font-bold text-slate-800 mb-6 border-b-2 border-slate-200 pb-3">📝 Formulir Tambah Agenda</h2>
    <form method="POST" enctype="multipart/form-data" action=""> <input type="hidden" name="submit" value="1"> <div class="mb-4">
            <label for="nama_kegiatan" class="block text-slate-700 text-sm font-bold mb-2">Nama Agenda</label>
            <input type="text" name="nama_kegiatan" id="nama_kegiatan" placeholder="Masukkan nama agenda" required maxlength="255"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
        </div>

        <div class="mb-4">
            <label for="waktu_kegiatan" class="block text-slate-700 text-sm font-bold mb-2">Waktu Agenda</label>
            <input type="date" name="waktu_kegiatan" id="waktu_kegiatan" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
        </div>

        <div class="mb-4">
            <label for="tempat_kegiatan" class="block text-slate-700 text-sm font-bold mb-2">Tempat Agenda</label>
            <input type="text" name="tempat_kegiatan" id="tempat_kegiatan" placeholder="Masukkan tempat agenda" required maxlength="255"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
        </div>

        <div class="mb-6">
            <label for="gambar" class="block text-slate-700 text-sm font-bold mb-2">Gambar Agenda</label>
            <input type="file" name="gambar" id="gambar" accept="image/jpeg,image/png,image/gif,image/webp" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            <p class="text-sm text-slate-500 mt-2">Format: JPG, PNG, GIF, WEBP. Maksimum 5MB.</p>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" name="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                Upload Agenda
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
</div>
</body>
</html>