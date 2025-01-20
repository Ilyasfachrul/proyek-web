<?php
include "koneksi.php";
session_start();

// Periksa apakah ada ID yang diterima
if (isset($_GET['id'])) {
    $fotoID = intval($_GET['id']);

    // Query untuk menghapus foto
    $query = "DELETE FROM foto WHERE FotoID = $fotoID";

    if (mysqli_query($con, $query)) {
        $_SESSION['message'] = "Foto berhasil dihapus.";
    } else {
        $_SESSION['message'] = "Gagal menghapus foto: " . mysqli_error($con);
    }
} else {
    $_SESSION['message'] = "ID tidak valid.";
}

header("Location: index.php"); // Kembali ke halaman utama
exit();
?>

