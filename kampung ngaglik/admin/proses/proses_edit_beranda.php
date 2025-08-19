<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

include '../../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    
    // Check if new image is uploaded
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['gambar'];
        $file_name = time() . '_' . basename($file['name']);
        $target_dir = "../../image/";
        $target_file = $target_dir . $file_name;
        
        // Validate file type
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (!in_array($imageFileType, $allowed_types)) {
            $_SESSION['error'] = "Jenis file tidak diizinkan. Gunakan JPG, JPEG, PNG, atau GIF.";
            header("Location: ../edit_beranda.php?id=$id");
            exit();
        }
        
        // Validate file size (max 5MB)
        if ($file['size'] > 5 * 1024 * 1024) {
            $_SESSION['error'] = "Ukuran file terlalu besar. Maksimum 5MB.";
            header("Location: ../edit_beranda.php?id=$id");
            exit();
        }
        
        // Get old image
        $query = "SELECT gambar FROM beranda WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $old_content = mysqli_fetch_assoc($result);
        $old_image = $old_content['gambar'];
        
        // Move new file
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            // Delete old image if exists
            if ($old_image && file_exists($target_dir . $old_image)) {
                unlink($target_dir . $old_image);
            }
            
            // Update database with new image
            $query = "UPDATE beranda SET judul = ?, deskripsi = ?, gambar = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sssi", $judul, $deskripsi, $file_name, $id);
        } else {
            $_SESSION['error'] = "Gagal mengunggah gambar.";
            header("Location: ../edit_beranda.php?id=$id");
            exit();
        }
    } else {
        // Update without changing image
        $query = "UPDATE beranda SET judul = ?, deskripsi = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssi", $judul, $deskripsi, $id);
    }
    
    // Execute update query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Konten berhasil diperbarui!";
        header("Location: ../uploud_beranda.php");
    } else {
        $_SESSION['error'] = "Gagal memperbarui konten.";
        header("Location: ../edit_beranda.php?id=$id");
    }
    
    mysqli_stmt_close($stmt);
} else {
    header("Location: ../uploud_beranda.php");
}

mysqli_close($conn);
?>