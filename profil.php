<?php
include "koneksi.php";
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['Username']) || !isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

// Ambil UserID dari session
$userID = $_SESSION['UserID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <style>
        /* Global Styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            color: #333;
        }

        /* Logout Button */
        .logout-btn {
            background-color: #ff4b4b;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #e04141;
        }

        /* Profile Container */
        .profile-container {
            max-width: 900px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 25px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .profile-header img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid #e2e2e2;
        }

        .profile-header .details h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .profile-header .details p {
            margin: 8px 0;
            color: #555;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            padding: 15px 0;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .stats div {
            text-align: center;
        }

        .stats div h3 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }

        .stats div p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }

        .albums, .photos {
            margin-top: 20px;
        }

        .albums h3, .photos h3 {
            margin-bottom: 15px;
            font-size: 20px;
            color: #333;
            border-left: 4px solid #e60023;
            padding-left: 10px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
        }

        .grid-item {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .grid-item:hover {

            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .grid-item img {
            width: 100%;
            height: auto;
        }

        .grid-item .info {
            padding: 10px;
            text-align: center;
            font-size: 14px;
            color: #555;
        }

        footer {
            margin-top: 50px;
            text-align: center;
            font-size: 14px;
            color: #888;
        }

        .logout-btn {
    background-color: #ff4b4b;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    font-size: 14px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s;
}

.logout-btn:hover {
    background-color: #e04141;
}
    </style>
</head>
<body>
<?php include "navbar.php"; ?>

<a href="logout.php" class="logout-btn">Logout</a>

    <div class="profile-container">
        <?php
        // Koneksi ke database
        $conn = new mysqli("localhost", "root", "", "gallerydb_plusdummy");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query untuk mengambil data pengguna
        $userQuery = "SELECT NamaLengkap, Username, Email, Alamat FROM user WHERE UserID = $userID";
        $userResult = $conn->query($userQuery);

        // Query untuk statistik
        $statsQuery = "SELECT 
                            (SELECT COUNT(*) FROM foto WHERE UserID = $userID) AS jumlahFoto,
                            (SELECT COUNT(*) FROM likefoto WHERE FotoID IN (SELECT FotoID FROM foto WHERE UserID = $userID)) AS TotalLikes,
                            (SELECT MIN(TanggalUnggah) FROM foto WHERE UserID = $userID) AS BergabungSejak";
        $statsResult = $conn->query($statsQuery);

        // Query untuk album dan foto
        $albumsQuery = "SELECT AlbumID, NamaAlbum, Deskripsi FROM album WHERE UserID = $userID";
        $albumsResult = $conn->query($albumsQuery);

        $photosQuery = "SELECT FotoID, JudulFoto, LokasiFoto FROM foto WHERE UserID = $userID";
        $photosResult = $conn->query($photosQuery);

        if ($userResult->num_rows > 0 && $statsResult->num_rows > 0) {
            $user = $userResult->fetch_assoc();
            $stats = $statsResult->fetch_assoc();

            echo "
            <div class='profile-header'>
                <img src='assets/¡! 𓈈 🌻 Kucing Gemoy.jpg' alt='Profile Picture'>
                <div class='details'>
                    <h2>{$user['NamaLengkap']}</h2>
                    <p>Username: {$user['Username']}</p>
                    <p>Email: {$user['Email']}</p>
                    <p>Alamat: {$user['Alamat']}</p>
                </div>
            </div>
            <div class='stats'>
                <div>
                    <h3>{$stats['jumlahFoto']}</h3>
                    <p>Total Foto</p>
                </div>
                <div>
                    <h3>{$stats['TotalLikes']}</h3>
                    <p>Total Likes</p>
                </div>
                <div>
                    
                </div>
            </div>";
        } else {
            echo "<p>Data pengguna tidak ditemukan.</p>";
        }
        ?>

        <div class="albums">
            <h3>Album</h3>
            <div class="grid">
                <?php
                if ($albumsResult->num_rows > 0) {
                    while ($album = $albumsResult->fetch_assoc()) {
                        echo "
                        <div class='grid-item'>
                            <div class='info'>
                                <strong>{$album['NamaAlbum']}</strong>
                                <p>{$album['Deskripsi']}</p>
                            </div>
                        </div>";
                    }
                } else {
                    echo "<p>Tidak ada album.</p>";
                }
                ?>
            </div>
        </div>

        <div class="photos">
            <h3>Foto</h3>
            <div class="grid">
                <?php
                if ($photosResult->num_rows > 0) {
                    while ($photo = $photosResult->fetch_assoc()) {
                        echo "
                        <div class='grid-item'>
                            <img src='uploads/{$photo['LokasiFoto']}' alt='{$photo['JudulFoto']}'>
                            <div class='info'>{$photo['JudulFoto']}</div>
                        </div>";
                    }
                } else {
                    echo "<p>Tidak ada foto.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>
</body>
</html>
