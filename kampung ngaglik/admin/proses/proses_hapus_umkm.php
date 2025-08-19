<?php
include '../../koneksi/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama gambar dari database
    $result = $conn->query("SELECT gambar FROM umkm WHERE id=$id");
    $row = $result->fetch_assoc();
    $gambar = $row['gambar'];

    // Hapus gambar dari folder
    if (file_exists("../image/" . $gambar)) {
        unlink("../image/" . $gambar);
    }

    // Hapus data dari database
    $conn->query("DELETE FROM umkm WHERE id=$id");

    header("Location: ../umkm.php");
}
?>
