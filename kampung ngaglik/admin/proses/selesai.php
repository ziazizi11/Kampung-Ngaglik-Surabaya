<?php
include '../koneksi/koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("UPDATE kegiatan SET status='Selesai' WHERE id=$id");
}

header("Location: ../uploud_kegiatan.php");
exit;
