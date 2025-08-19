<?php
include '../../koneksi/koneksi.php';

$id = $_POST['id'];
$nama_produk = $_POST['nama_produk'];
$alamat = $_POST['alamat'];
$pemilik = $_POST['pemilik'];

// Ambil data lama untuk gambar
$query = $conn->query("SELECT gambar FROM umkm WHERE id = $id");
$data = $query->fetch_assoc();
$gambar_lama = $data['gambar'];

if ($_FILES['gambar']['name'] != "") {
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    $ekstensi = pathinfo($gambar, PATHINFO_EXTENSION);
    $nama_baru = uniqid() . '.' . $ekstensi;
    $path = "../../image/" . $nama_baru;

    // Pindahkan file
    if (move_uploaded_file($tmp, $path)) {
        // Hapus gambar lama
        if (file_exists("../../image/" . $gambar_lama)) {
            unlink("../../image/" . $gambar_lama);
        }

        // Update data dengan gambar baru
        $sql = "UPDATE umkm SET nama_produk='$nama_produk', alamat='$alamat', pemilik='$pemilik', gambar='$nama_baru' WHERE id=$id";
    } else {
        echo "Gagal upload gambar baru.";
        exit();
    }
} else {
    // Update tanpa mengubah gambar
    $sql = "UPDATE umkm SET nama_produk='$nama_produk', alamat='$alamat', pemilik='$pemilik' WHERE id=$id";
}

if ($conn->query($sql)) {
    header("Location: ../umkm.php");
    exit();
} else {
    echo "Gagal update data: " . $conn->error;
}
?>
