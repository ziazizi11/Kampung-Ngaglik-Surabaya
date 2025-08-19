<?php
include '../../koneksi/koneksi.php';
session_start();

// Hanya superadmin yang bisa akses
if (!isset($_SESSION['admin_role']) || $_SESSION['admin_role'] != 'superadmin') {
    header("Location: ../dashboard.php");
    exit;
}

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$role = $_POST['role'];

$query = "INSERT INTO admin (nama, email, password, role) VALUES ('$nama', '$email', '$password', '$role')";

if ($conn->query($query)) {
    header("Location: ../dashboard.php?pesan=registrasi_berhasil");
} else {
    echo "Gagal registrasi: " . $conn->error;
}
?>
