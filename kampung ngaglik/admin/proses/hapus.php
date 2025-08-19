<?php
include '../koneksi/koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Hapus gambar dari folder
    $get = $conn->query("SELECT gambar FROM kegiatan WHERE id=$id")->fetch_assoc();
    if ($get && file_exists("../image/" . $get['gambar'])) {
        unlink("..proses/image/" . $get['gambar']);
    }

    // Hapus dari database
    $conn->query("DELETE FROM kegiatan WHERE id=$id");
}

header("Location: ../uploud_kegiatan.php");
exit;
