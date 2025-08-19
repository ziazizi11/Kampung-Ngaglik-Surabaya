<?php
include '../../koneksi/koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil data gambar terlebih dahulu
    $q = mysqli_query($conn, "SELECT gambar FROM beranda WHERE id = $id");
    $data = mysqli_fetch_assoc($q);
    
    if ($data) {
        $gambar = $data['gambar'];

        // Hapus dari database
        mysqli_query($conn, "DELETE FROM beranda WHERE id = $id");

        // Hapus file gambar jika ada
        $filePath = "../image/" . $gambar;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}

header("Location: ../uploud_beranda.php");
exit;
