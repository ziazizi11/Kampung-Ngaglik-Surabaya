<?php
include '../../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi_singkat = mysqli_real_escape_string($conn, $_POST['deskripsi_singkat']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $path = "../../image/" . basename($gambar);

    // Fetch existing data to keep the old image if no new one is uploaded
    $query = mysqli_query($conn, "SELECT gambar FROM berita WHERE id = '$id'");
    $old_data = mysqli_fetch_assoc($query);
    $old_gambar = $old_data['gambar'];

    $new_gambar = $old_gambar;
    if (!empty($gambar) && move_uploaded_file($tmp, $path)) {
        // Delete old image if a new one is uploaded (optional)
        if (file_exists("../../image/" . $old_gambar) && $old_gambar != $gambar) {
            unlink("../../image/" . $old_gambar);
        }
        $new_gambar = $gambar;
    }

    $update_query = "UPDATE berita SET 
                     judul = '$judul',
                     deskripsi_singkat = '$deskripsi_singkat',
                     deskripsi = '$deskripsi',
                     gambar = '$new_gambar'
                     WHERE id = '$id'";

    if (mysqli_query($conn, $update_query)) {
        header("Location: ../uploud_berita.php?status=updated");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>