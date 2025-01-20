<?php
session_start();
include "koneksi.php";

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $namaPengirim = $_POST['name'];
    $emailPengirim = $_POST['email'];
    $isiPesan = $_POST['message'];

    // Persiapkan query untuk menyimpan data ke tabel pesan
    $query = "INSERT INTO kontak (Nama, Email, Pesan) VALUES (?, ?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("sss", $namaPengirim, $emailPengirim, $isiPesan);

    if ($stmt->execute()) {
        $_SESSION['message_status'] = 'Pesan terkirim';
        $_SESSION['status'] = 'success';
    } else {
        $_SESSION['message_status'] = 'Pesan gagal terkirim';
        $_SESSION['status'] = 'error';
    }

    // Redirect untuk menghindari pengiriman data berulang
    header("Location: contact.php");
    exit();
}
?>