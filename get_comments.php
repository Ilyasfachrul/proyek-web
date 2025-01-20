<?php
$conn = new mysqli("localhost", "root", "", "gallerydb_plusdummy");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fotoID = isset($_GET['FotoID']) ? intval($_GET['FotoID']) : 0;

if ($fotoID > 0) {
    $sql = "SELECT k.IsiKomentar, k.TanggalKomentar, u.NamaLengkap 
            FROM komentarfoto k
            JOIN user u ON k.UserID = u.UserID
            WHERE k.FotoID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $fotoID);
    $stmt->execute();
    $result = $stmt->get_result();

    $comments = [];
    while ($row = $result->fetch_assoc()) {
        $comments[] = [
            'IsiKomentar' => $row['IsiKomentar'],
            'TanggalKomentar' => $row['TanggalKomentar'],
            'NamaLengkap' => $row['NamaLengkap']
        ];
    }

    echo json_encode(['success' => true, 'comments' => $comments]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid FotoID']);
}

$conn->close();
?>
