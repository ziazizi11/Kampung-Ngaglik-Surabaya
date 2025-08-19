<?php
include 'koneksi/koneksi.php';
include 'header.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$query = mysqli_query($conn, "SELECT * FROM berita WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<div class='p-10 text-center text-red-600'>Data tidak ditemukan.</div>";
    include 'footer.php';
    exit;
}
?>

<div class="bg-[#f3f4f6] min-h-screen py-10 px-4">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4"><?= htmlspecialchars($data['judul']) ?></h2>
        <img src="image/<?= htmlspecialchars($data['gambar']) ?>" class="w-full h-80 object-cover rounded mb-4" alt="Gambar Agenda">
        <p class="text-justify mb-4 leading-relaxed"><?= nl2br(htmlspecialchars($data['deskripsi'])) ?></p>
        <p class="text-gray-600 text-sm">🕒 <?= $data['created_at'] ?></p>
        <a href="agenda.php" class="inline-block mt-6 text-blue-500 hover:underline">← Kembali ke Daftar Agenda</a>
    </div>
</div>

<?php include 'footer.php'; ?>
