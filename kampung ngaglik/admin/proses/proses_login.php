<?php
session_start();
include '../../koneksi/koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];

$result = $conn->query("SELECT * FROM admin WHERE email = '$email'");

if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
    if (password_verify($password, $admin['password'])) {
        $_SESSION['admin_name'] = $admin['nama'];
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_role'] = $admin['role']; // simpan role

        header("Location: ../dashboard.php");
        exit;
    } else {
        echo "Password salah.";
    }
} else {
    echo "Email tidak ditemukan.";
}
?>
