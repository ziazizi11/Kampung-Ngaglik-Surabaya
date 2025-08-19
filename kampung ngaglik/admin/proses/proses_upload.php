<?php
include '../../koneksi/koneksi.php';

if (!isset($conn) || !$conn) {
    die("Koneksi database gagal.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['banner'];

    // Validasi file
    $allowedTypes = ['jpg', 'jpeg', 'png', 'webp'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if ($file['error'] === 0 && in_array($ext, $allowedTypes)) {
        $targetDir = "../../image/";
        $newName = "banner_" . time() . "." . $ext;
        $targetPath = $targetDir . $newName;

        // Ambil banner lama
        $getOld = mysqli_query($conn, "SELECT value FROM pengaturan WHERE nama = 'foto benner'");
        $oldData = mysqli_fetch_assoc($getOld);
        $oldFile = isset($oldData['value']) ? $oldData['value'] : null;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            if ($oldFile && file_exists($targetDir . $oldFile)) {
                unlink($targetDir . $oldFile);
            }

            $update = mysqli_query($conn, "UPDATE pengaturan SET value = '$newName' WHERE nama = 'foto benner'");
            if (mysqli_affected_rows($conn) === 0) {
                mysqli_query($conn, "INSERT INTO pengaturan (nama, value) VALUES ('foto benner', '$newName')");
            }

            echo "<script>alert('Banner berhasil diperbarui!'); window.location.href='../uploud_benner.php';</script>";
        } else {
            echo "<script>alert('Upload gagal saat memindahkan file.'); history.back();</script>";
        }
    } else {
        echo "<script>alert('File harus JPG, PNG, atau WEBP.'); history.back();</script>";
    }
} else {
    echo "<script>alert('Metode tidak valid.'); history.back();</script>";
}
?>
