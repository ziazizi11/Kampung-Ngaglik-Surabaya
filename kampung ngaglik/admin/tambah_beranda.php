<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include 'header.php'; // Ini akan memuat sidebar dan semua gaya dasar (termasuk Tailwind CSS)
include '../koneksi/koneksi.php'; // Pastikan koneksi database juga disertakan
?>

<div class="header-title mb-8">
    <h1 class="text-3xl font-bold text-slate-800">
        Tambah Konten Beranda Baru
    </h1>
    <p class="text-slate-500 mt-1">Isi formulir di bawah untuk menambahkan konten baru ke halaman beranda.</p>
</div>

<div class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 border-b-2 border-slate-200 pb-3">📝 Formulir Tambah Konten</h2>
    <form action="proses/proses_upload_beranda.php" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="judul" class="block text-slate-700 text-sm font-bold mb-2">Judul</label>
            <input type="text" id="judul" name="judul" placeholder="Masukkan judul konten" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
        </div>
        <div class="mb-4">
            <label for="deskripsi" class="block text-slate-700 text-sm font-bold mb-2">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="6" placeholder="Tuliskan deskripsi konten" required
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out"></textarea>
        </div>
        <div class="mb-6">
            <label for="gambar" class="block text-slate-700 text-sm font-bold mb-2">Gambar</label>
            <input type="file" id="gambar" name="gambar" accept="image/*" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                Upload Konten
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