<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

include '../../koneksi/koneksi.php';

// Initialize error and success messages
$_SESSION['error'] = '';
$_SESSION['success'] = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $nama = isset($_POST['nama_kegiatan']) ? trim($_POST['nama_kegiatan']) : '';
    $waktu = isset($_POST['waktu_kegiatan']) ? trim($_POST['waktu_kegiatan']) : '';
    $tempat = isset($_POST['tempat_kegiatan']) ? trim($_POST['tempat_kegiatan']) : '';
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';

    // Validate inputs
    if (empty($nama) || empty($waktu) || empty($tempat) || empty($status)) {
        $_SESSION['error'] = "Semua field harus diisi.";
        header("Location: ../edit_kegiatan.php?id=$id");
        exit();
    }

    // Validate status value (updated to include 'Selesai')
    $valid_statuses = ['Aktif', 'Non-Aktif', 'Selesai'];
    if (!in_array($status, $valid_statuses)) {
        $_SESSION['error'] = "Status tidak valid. Harus 'Aktif', 'Non-Aktif', atau 'Selesai'.";
        header("Location: ../edit_kegiatan.php?id=$id");
        exit();
    }

    // Check if a new image is uploaded
    $gambar = '';
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 5 * 1024 * 1024; // 5MB
        $file_type = $_FILES['gambar']['type'];
        $file_size = $_FILES['gambar']['size'];
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $file_name = $_FILES['gambar']['name'];

        // Validate file type and size
        if (!in_array($file_type, $allowed_types)) {
            $_SESSION['error'] = "Format gambar tidak valid. Gunakan JPG, PNG, atau GIF.";
            header("Location: ../edit_kegiatan.php?id=$id");
            exit();
        }

        if ($file_size > $max_size) {
            $_SESSION['error'] = "Ukuran gambar terlalu besar. Maksimum 5MB.";
            header("Location: ../edit_kegiatan.php?id=$id");
            exit();
        }

        // Generate unique file name
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $gambar = 'kegiatan_' . time() . '.' . $extension;
        $upload_path = '../../proses/image/' . $gambar;

        // Move uploaded file
        if (!move_uploaded_file($file_tmp, $upload_path)) {
            $_SESSION['error'] = "Gagal mengunggah gambar.";
            header("Location: ../edit_kegiatan.php?id=$id");
            exit();
        }

        // Delete old image if it exists
        $query = "SELECT gambar FROM kegiatan WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $old_content = mysqli_fetch_assoc($result);
        if ($old_content && !empty($old_content['gambar']) && file_exists('../../proses/image/' . $old_content['gambar'])) {
            unlink('../../proses/image/' . $old_content['gambar']);
        }
    } else {
        // If no new image is uploaded, keep the existing image
        $query = "SELECT gambar FROM kegiatan WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $old_content = mysqli_fetch_assoc($result);
        $gambar = $old_content['gambar'];
    }

    // Update database
    $query = "UPDATE kegiatan SET nama_kegiatan = ?, waktu_kegiatan = ?, tempat_kegiatan = ?, status = ?, gambar = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssssi", $nama, $waktu, $tempat, $status, $gambar, $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Kegiatan berhasil diperbarui.";
        header("Location: ../uploud_kegiatan.php");
        exit();
    } else {
        $_SESSION['error'] = "Gagal memperbarui kegiatan: " . mysqli_error($conn);
        header("Location: ../edit_kegiatan.php?id=$id");
        exit();
    }
} else {
    $_SESSION['error'] = "Metode request tidak valid.";
    header("Location: ../edit_kegiatan.php?id=$id");
    exit();
}
?>