<?php
include "koneksi.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fotoID = intval($_POST['id']);
    $judul = mysqli_real_escape_string($con, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($con, $_POST['deskripsi']);

    // Periksa apakah ada file yang diunggah
    if ($_FILES['foto']['name']) {
        $fileName = $_FILES['foto']['name'];
        $fileTmpName = $_FILES['foto']['tmp_name'];
        $filePath = "uploads/" . $fileName;

        // Pindahkan file ke folder uploads
        if (move_uploaded_file($fileTmpName, $filePath)) {
            $query = "UPDATE foto SET JudulFoto='$judul', DeskripsiFoto='$deskripsi', LokasiFoto='$fileName' WHERE FotoID=$fotoID";
        } else {
            $_SESSION['message'] = "Gagal mengunggah file.";
            header("Location: edit.php?id=$fotoID");
            exit();
        }
    } else {
        $query = "UPDATE foto SET JudulFoto='$judul', DeskripsiFoto='$deskripsi' WHERE FotoID=$fotoID";
    }

    if (mysqli_query($con, $query)) {
        $_SESSION['message'] = "Foto berhasil diperbarui.";
    } else {
        $_SESSION['message'] = "Gagal memperbarui foto: " . mysqli_error($con);
    }
}

header("Location: index.php");
exit();
?>
