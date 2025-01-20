<?php
session_start();
include "koneksi.php";

// Cek apakah pengguna sudah login
if (!isset($_SESSION['UserID'])) {
    error_log("Session UserID not set");
    echo json_encode(['success' => false, 'message' => 'User belum login']);
    exit();
}

// Validasi input
if (empty($_POST['FotoID']) || empty($_POST['IsiKomentar'])) {
    echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
    exit();
}

$fotoID = $_POST['FotoID'];
$comment = $_POST['IsiKomentar'];
$userID = $_SESSION['UserID'];

// Log untuk debugging
error_log("FotoID: " . $fotoID);
error_log("IsiKomentar: " . $comment);
error_log("UserID: " . $userID);

// Gunakan prepared statement
$query = "INSERT INTO komentarfoto (FotoID, UserID, IsiKomentar, TanggalKomentar) VALUES (?, ?, ?, NOW())";
$stmt = $con->prepare($query);

if ($stmt) {
    $stmt->bind_param('iis', $fotoID, $userID, $comment);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        error_log("Statement execution failed: " . $stmt->error);
        echo json_encode(['success' => false, 'message' => 'Gagal menambahkan komentar']);
    }

    $stmt->close();
} else {
    error_log("Failed to prepare statement: " . $con->error);
    echo json_encode(['success' => false, 'message' => 'Gagal mempersiapkan query']);
}

$con->close();
?>
