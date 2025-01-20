<?php
include "koneksi.php";
session_start();

// Periksa apakah ada ID yang diterima
if (isset($_GET['id'])) {
    $fotoID = intval($_GET['id']);

    // Ambil data foto berdasarkan ID
    $query = "SELECT * FROM foto WHERE FotoID = $fotoID";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        $_SESSION['message'] = "Data foto tidak ditemukan.";
        header("Location: index.php");
        exit();
    }
} else {
    $_SESSION['message'] = "ID tidak valid.";
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Foto</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        header {
            background-color: #0073e6;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        h3 {
            color: #333;
            text-align: center;
            margin: 20px 0;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
        }

        form label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
            font-weight: bold;
        }

        form input, form textarea, form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        form textarea {
            resize: none;
        }

        form button {
            background-color: #0073e6;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #005bb5;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #aaa;
        }

        .message {
            text-align: center;
            color: green;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h3>Edit Foto</h3>
    <form action="update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $data['FotoID']; ?>">

        <label for="judul">Judul Foto:</label>
        <input type="text" id="judul" name="judul" value="<?php echo $data['JudulFoto']; ?>" required>

        <label for="deskripsi">Deskripsi Foto:</label>
        <textarea id="deskripsi" name="deskripsi" rows="4" required><?php echo $data['DeskripsiFoto']; ?></textarea>

        <label for="foto">Ganti Foto (Opsional):</label>
        <input type="file" id="foto" name="foto">

        <button type="submit">Simpan Perubahan</button>
    </form>
    <footer>
        <p>&copy; 2025 Gallery App. All Rights Reserved.</p>
    </footer>
</body>
</html>

