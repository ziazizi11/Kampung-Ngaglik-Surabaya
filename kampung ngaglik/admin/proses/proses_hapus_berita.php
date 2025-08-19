<?php
include '../../koneksi/koneksi.php';
$id = $_GET['id'];

// hapus gambar dari folder
$get = mysqli_fetch_assoc(mysqli_query($conn, "SELECT gambar FROM berita WHERE id = $id"));
if ($get && file_exists("../../image/" . $get['gambar'])) {
    unlink("../../image/" . $get['gambar']);
}

mysqli_query($conn, "DELETE FROM berita WHERE id = $id");
header("Location: ../uploud_berita.php");
exit;
?>
