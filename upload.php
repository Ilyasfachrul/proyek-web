<?php
include "koneksi.php";
session_start();
$userID = $_SESSION['UserID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = mysqli_real_escape_string($con, $_POST["judul"]);
    $deskripsi = mysqli_real_escape_string($con, $_POST["deskripsi"]);
    $tanggal = mysqli_real_escape_string($con, $_POST["tanggal"]);
    $albumID = intval($_POST["album"]); 

    $foto = $_FILES["foto"]["name"];
    $tmpName = $_FILES["foto"]["tmp_name"];
    $uploadDir = "uploads/";
    $uploadPath = $uploadDir . basename($foto);

    if (move_uploaded_file($tmpName, $uploadPath)) {
        $query = "INSERT INTO foto (JudulFoto, DeskripsiFoto, TanggalUnggah, LokasiFoto, AlbumID, UserID) 
                  VALUES ('$judul', '$deskripsi', '$tanggal', '$foto', $albumID, $userID)";

        if (mysqli_query($con, $query)) {
            $_SESSION["message"] = "Foto berhasil diunggah.";
        } else {
            $_SESSION["message"] = "Terjadi kesalahan: " . mysqli_error($con);
        }
    } else {
        $_SESSION["message"] = "Gagal mengunggah file.";
    }

    header("Location: index.php");
    exit();
}
?>
