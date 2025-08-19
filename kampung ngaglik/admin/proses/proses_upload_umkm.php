<?php
// Koneksi ke database
include '../../koneksi/koneksi.php'; // Sesuaikan jalur file koneksi

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $alamat = $_POST['alamat'];
    $pemilik = $_POST['pemilik'];

    // Proses gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];

    // Buat nama unik agar tidak bentrok
    $gambar_baru = uniqid() . "_" . basename($gambar);

    // Pastikan folder image/ ada
    $target_dir = '../../image/';
    $target_file = $target_dir . $gambar_baru;

    // Jika folder tidak ada, buat
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Pindahkan gambar
    if (move_uploaded_file($tmp_name, $target_file)) {
        $query = "INSERT INTO umkm (nama_produk, alamat, pemilik, gambar) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $nama_produk, $alamat, $pemilik, $gambar_baru);

        if ($stmt->execute()) {
            header("Location: ../umkm.php?status=success");
            exit();
        } else {
            echo "Gagal menyimpan data ke database.";
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }
}
?>
