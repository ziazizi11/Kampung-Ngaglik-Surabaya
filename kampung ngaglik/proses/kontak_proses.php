<?php
include '../koneksi/koneksi.php';

// Tangkap dan amankan data dari form
$nama   = mysqli_real_escape_string($conn, $_POST['name']);
$email  = mysqli_real_escape_string($conn, $_POST['email']);
$subjek = mysqli_real_escape_string($conn, $_POST['subject']);
$pesan  = mysqli_real_escape_string($conn, $_POST['message']);

// Validasi sederhana
if (!empty($nama) && !empty($email) && !empty($subjek) && !empty($pesan)) {
    $query = "INSERT INTO kontak (nama, email, subjek, pesan, tanggal_kirim)
              VALUES ('$nama', '$email', '$subjek', '$pesan', NOW())";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Berhasil simpan ke database
        header("Location: ../kontak.php?success=1");
        exit;
    } else {
        // Gagal simpan
        header("Location: ../kontak.php?error=1");
        exit;
    }
} else {
    // Data tidak lengkap
    header("Location: ../kontak.php?error=2");
    exit;
}
?>
