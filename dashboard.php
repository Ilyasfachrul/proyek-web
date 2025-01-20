<?php
include "koneksi.php";
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

// Ambil UserID dari sesi login
$userID = $_SESSION['UserID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foto Upload & Gallery</title>
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
            margin: 20px 0 10px;
            text-align: center;
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

        form input, form textarea, form select, form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        form button {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #218838;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            margin: 0 auto;
            max-width: 1200px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .card .info {
            padding: 15px;
        }

        .card .info h4 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        .card .info p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }

        .card .actions {
            display: flex;
            justify-content: space-between;
            padding: 10px 15px;
        }

        .card .actions a {
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            color: white;
            transition: all 0.3s ease;
        }

        .card .actions a.edit {
            background-color: #007bff;
        }

        .card .actions a.edit:hover {
            background-color: #0056b3;
        }

        .card .actions a.delete {
            background-color: #dc3545;
        }

        .card .actions a.delete:hover {
            background-color: #c82333;
        }

        footer {
            text-align: center;
            margin: 20px 0;
            font-size: 14px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>

    <h3>Unggah Foto Baru</h3>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="judul">Judul Foto:</label>
        <input type="text" id="judul" name="judul" placeholder="Masukkan judul foto" required>

        <label for="deskripsi">Deskripsi Foto:</label>
        <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi foto" required></textarea>

        <label for="tanggal">Tanggal Unggah:</label>
        <input type="date" id="tanggal" name="tanggal" required>

        <label for="foto">Upload Foto:</label>
        <input type="file" id="foto" name="foto" required>

        <label for="album">Album:</label>
        <select name="album" id="album" required>
        <?php
            $query = "SELECT * FROM album";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['AlbumID']}'>{$row['NamaAlbum']}</option>";
            }
            ?>
        </select>
        <button type="submit">Submit</button>
    </form>

    <h3>Galeri Foto</h3>
    <div class="gallery">
        <?php
        $query = "SELECT 
                    foto.FotoID, 
                    foto.JudulFoto, 
                    foto.DeskripsiFoto, 
                    foto.TanggalUnggah, 
                    foto.LokasiFoto, 
                    album.NamaAlbum, 
                    (SELECT COUNT(*) FROM likefoto WHERE likefoto.FotoID = foto.FotoID) AS JumlahLike, 
                    (SELECT COUNT(*) FROM komentarfoto WHERE komentarfoto.FotoID = foto.FotoID) AS JumlahKomentar
                FROM foto
                INNER JOIN album ON foto.AlbumID = album.AlbumID
                WHERE foto.UserID = $userID"; // Filter foto berdasarkan UserID
        $result = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='card'>
                    <img src='uploads/{$row['LokasiFoto']}' alt='{$row['JudulFoto']}'>
                    <div class='info'>
                        <h4>{$row['JudulFoto']}</h4>
                        <p>{$row['DeskripsiFoto']}</p>
                        <p>Album: {$row['NamaAlbum']}</p>
                        <p>Tanggal Upload: " . date('d M Y', strtotime($row['TanggalUnggah'])) . "</p>
                        <p>Likes: {$row['JumlahLike']} | Komentar: {$row['JumlahKomentar']}</p>
                    </div>
                    <div class='actions'>
                        <a href='edit.php?id={$row['FotoID']}' class='edit'>Edit</a>
                        <a href='delete.php?id={$row['FotoID']}' class='delete' onclick='return confirmDelete()'>Delete</a>
                    </div>
                </div>";
        }
        ?>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Apakah Anda yakin ingin menghapus foto ini?");
        }
    </script>
    <?php include "footer.php"; ?>
</body>
</html>
