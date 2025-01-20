<?php
// Mulai sesi
session_start();

// Menyertakan koneksi ke database
include "koneksi.php";

// Proses saat tombol "register" ditekan
if (isset($_POST['register'])) {
    // Mengambil data dari form
    $NamaLengkap = mysqli_real_escape_string($con, $_POST['NamaLengkap']);
    $Username = mysqli_real_escape_string($con, $_POST['Username']);
    $Email = mysqli_real_escape_string($con, $_POST['Email']);
    $Password = isset($_POST["Password"]) ? password_hash($_POST["Password"], PASSWORD_DEFAULT) : null;
    $Alamat = mysqli_real_escape_string($con, $_POST['Alamat']);

    // Validasi password
    if ($Password === null) {
        die("Password tidak boleh kosong!");
    }

    // Query untuk memasukkan data ke database
    $sql = "INSERT INTO user (NamaLengkap, Username, Email, Password, Alamat) 
            VALUES ('$NamaLengkap', '$Username', '$Email', '$Password', '$Alamat')";

    // Menjalankan query
    if (mysqli_query($con, $sql)) {
        $_SESSION['message'] = "Akun berhasil dibuat!";
        header("Location: index.php"); // Redirect ke halaman lain setelah sukses
        exit();
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <style>
        /* Global styles */
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('assets/2025011921000917.jpg'); /* Path ke gambar background */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container styles */
        .container {
            background-color: rgba(255, 255, 255, 0.85); /* Transparansi */
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            position: relative;
        }

        /* Gradient text */
        h2 {
            text-align: center;
            background: linear-gradient(90deg, #90ee90, #87cefa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 14px;
            margin-top: 5px;
        }

        textarea {
            resize: vertical;
        }

        /* Button styling */
        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #32cd32, #4682b4);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
            transition: 0.3s;
        }

        .btn:hover {
            background: linear-gradient(90deg, #4682b4, #32cd32);
        }

        /* Back button styles */
        .back-btn {
            margin-top: 10px;
            display: block;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            color: #007bff;
            transition: color 0.3s ease;
        }

        .back-btn:hover {
            color: #0056b3;
        }

        /* Popup styles */
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            z-index: 1000;
            display: none;
        }

        .popup h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .popup p {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        .popup button {
            padding: 10px 20px;
            border: none;
            background: linear-gradient(90deg, #32cd32, #4682b4);
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        .popup button:hover {
            background: linear-gradient(90deg, #4682b4, #32cd32);
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            .btn {
                padding: 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <form id="registerForm" action="" method="POST">
            <h2>Registrasi</h2>
            <div class="form-group">
                <label for="NamaLengkap">Nama Lengkap</label>
                <input class="form-control" type="text" name="NamaLengkap" id="NamaLengkap" placeholder="Nama Lengkap" required />
            </div>

            <div class="form-group">
                <label for="Username">Username</label>
                <input class="form-control" type="text" name="Username" id="Username" placeholder="Username" required />
            </div>

            <div class="form-group">
                <label for="Email">Email</label>
                <input class="form-control" type="email" name="Email" id="Email" placeholder="Alamat Email" required />
            </div>

            <div class="form-group">
                <label for="Password">Password</label>
                <input class="form-control" type="password" name="Password" id="Password" placeholder="Password" required />
            </div>

            <div class="form-group">
                <label for="Alamat">Alamat</label>
                <textarea class="form-control" name="Alamat" id="Alamat" placeholder="Alamat Lengkap" rows="3" required></textarea>
            </div>

            <input type="button" class="btn btn-success btn-block" value="Daftar" onclick="showPopup()" />

            <!-- Back to login button -->
            <a href="login.php" class="back-btn">Kembali ke Login</a>
        </form>
    </div>

    <div id="popup" class="popup">
        <h2>Registrasi Berhasil</h2>
        <p>Terima kasih telah mendaftar. Silakan tunggu beberapa saat.</p>
        <button onclick="closePopup()">Tutup</button>
    </div>

    <script>
        function showPopup() {
            const form = document.getElementById('registerForm');
            if (form.checkValidity()) {
                document.getElementById('popup').style.display = 'block';
                setTimeout(() => form.submit(), 2000); // Submit form setelah 2 detik
            } else {
                form.reportValidity();
            }
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }
    </script>
</body>
</html>
