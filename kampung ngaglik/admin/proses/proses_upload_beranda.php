<?php
include '../../koneksi/koneksi.php';

$judul = mysqli_real_escape_string($conn, $_POST['judul']);
$deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

// Proses upload gambar
$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];
$path = "../../image/" . $gambar;

if (move_uploaded_file($tmp, $path)) {
    $query = "INSERT INTO beranda (judul, deskripsi, gambar) VALUES ('$judul', '$deskripsi', '$gambar')";
    mysqli_query($conn, $query);
    header("Location: ../uploud_beranda.php");
} else {
    echo "Gagal upload gambar.";
}
?>
