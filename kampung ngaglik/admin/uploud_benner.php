<?php
// Memulai sesi untuk memeriksa status login
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Menggunakan path relatif yang benar dari 'admin/'
include '../koneksi/koneksi.php'; // Naik satu level ke root proyek, lalu ke koneksi
include 'header.php'; // header.php ada di folder yang sama (admin/)

// Ambil data banner dari database
$q = mysqli_query($conn, "SELECT value FROM pengaturan WHERE nama = 'foto benner'");
$data = mysqli_fetch_assoc($q);
$currentBanner = isset($data['value']) ? $data['value'] : 'default_banner.png'; // Ubah 'benner.png' ke nama default yang lebih jelas

// Cek file lama ada atau tidak, dan ambil waktu terakhir diubah
$imagePath = "../image/" . $currentBanner; // Path relatif dari admin/ ke image/
$lastUpdated = "Informasi tidak tersedia.";
if (file_exists($imagePath)) {
    $lastUpdated = date("d F Y H:i:s", filemtime($imagePath));
} else {
    $lastUpdated = "Gambar tidak ditemukan di server.";
}
?>

<div class="header-title mb-8">
    <h1 class="text-3xl font-bold text-slate-800">
        Kelola Banner Beranda
    </h1>
    <p class="text-slate-500 mt-1">Ubah gambar banner yang tampil di halaman utama website.</p>
</div>

<div class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 border-b-2 border-slate-200 pb-3">🖼️ Ubah Gambar Banner</h2>

    <div class="mb-6">
        <label class="block text-slate-700 text-sm font-bold mb-2">Gambar Banner Saat Ini:</label>
        <div class="border border-slate-200 rounded-lg p-4 flex flex-col items-center justify-center bg-slate-50">
            <img src="../image/<?= htmlspecialchars($currentBanner) ?>" alt="Current Banner" class="max-w-full h-auto rounded-md shadow-md mb-3 object-contain">
            <small class="text-slate-600">Terakhir diperbarui: <span class="font-semibold"><?= $lastUpdated ?></span></small>
        </div>
    </div>

    <form method="POST" enctype="multipart/form-data" action="proses/proses_upload.php">
        <div class="mb-6">
            <label for="bannerInput" class="block text-slate-700 text-sm font-bold mb-2">Pilih Gambar Banner Baru:</label>
            <label class="upload-box flex flex-col items-center justify-center p-8 border-2 border-dashed border-blue-400 rounded-lg bg-blue-50 cursor-pointer hover:bg-blue-100 transition-all duration-300">
                <i class="fas fa-upload text-blue-600 text-4xl mb-3"></i>
                <div class="text-blue-700 text-center font-medium">
                    Klik di sini untuk pilih gambar baru<br>
                    <small class="text-slate-500">(Format yang disarankan: JPG, PNG, WEBP | Maks: 5MB)</small>
                </div>
                <input type="file" name="banner" id="bannerInput" accept="image/jpeg, image/png, image/webp" class="hidden" required>
            </label>
            <div id="fileName" class="mt-3 text-green-600 text-sm text-center"></div>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                <i class="fas fa-save mr-2"></i> Update Banner
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('bannerInput').addEventListener('change', function() {
        const fileNameDisplay = document.getElementById('fileName');
        if (this.files.length > 0) {
            fileNameDisplay.textContent = "📁 File dipilih: " + this.files[0].name;
            // Opsional: Tampilkan preview gambar yang dipilih
            // const reader = new FileReader();
            // reader.onload = function(e) {
            //     const imgPreview = document.querySelector('.banner-preview img');
            //     if (imgPreview) {
            //         imgPreview.src = e.target.result;
            //     }
            // };
            // reader.readAsDataURL(this.files[0]);
        } else {
            fileNameDisplay.textContent = '';
        }
    });
</script>

<?php
// Konten diakhiri sebelum baris ini.
// Pastikan </body> dan </html> ditutup oleh header.php atau footer.php jika ada.
?>
</main>
</div>
</body>
</html>