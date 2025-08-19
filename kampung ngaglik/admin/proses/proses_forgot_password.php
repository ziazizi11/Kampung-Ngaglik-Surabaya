<?php
session_start();
include '../../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if email exists in admin table
    $query = "SELECT id FROM admin WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Email exists, generate reset token
        $token = bin2hex(random_bytes(32));
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expires in 1 hour

        // Store token in password_reset_tokens table (line 22)
        $query = "INSERT INTO password_reset_tokens (email, token, created_at, expires_at) VALUES (?, ?, NOW(), ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sss", $email, $token, $expires_at);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success'] = "Permintaan reset password berhasil. Silakan periksa email Anda untuk langkah selanjutnya.";
        } else {
            $_SESSION['error'] = "Gagal memproses permintaan reset password.";
        }
    } else {
        $_SESSION['error'] = "Email tidak terdaftar.";
    }

    mysqli_stmt_close($stmt);
    header("Location: ../login.php");
    exit();
} else {
    header("Location: ../login.php");
    exit();
}

mysqli_close($conn);
?>