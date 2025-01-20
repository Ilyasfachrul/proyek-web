<?php
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            margin-top: 50px;
            padding: 20px;
        }

        .text-center {
            color: #007bff;
        }

        .card {
            border-radius: 8px;
            border: none;
        }

        .card i {
            color: #007bff;
        }

        .card h5 {
            font-size: 20px;
            font-weight: bold;
        }

        .btn-outline-primary {
            border-radius: 6px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form .form-label {
            font-weight: bold;
        }

        form .form-control {
            border-radius: 6px;
        }

        form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #0056b3;
        }

        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            display: none;
            z-index: 1000;
        }

        .popup i {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .popup.success i {
            color: #28a745;
        }

        .popup.error i {
            color: #dc3545;
        }

        .popup button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
        }

        .popup button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <h2 class="text-center">Kontak Kami</h2>
        <p class="text-center text-muted mb-5">Hubungi kami melalui informasi di bawah ini atau kirimkan pesan Anda melalui formulir kontak.</p>

        <!-- Contact Info Section -->
        <div class="row text-center gy-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4">
                    <i class="fas fa-map-marker-alt fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold">Alamat</h5>
                    <p class="mb-1">Jl. Graha Jati No.2, Lagadar, Kec. Margaasih</p>
                    <p class="mb-3">Kabupaten Bandung, Jawa Barat, 40216</p>
                    <a href="https://maps.app.goo.gl/nc6k2bEvusTKVuE16" class="btn btn-link text-decoration-none text-primary" target="_blank">Lihat Lokasi di Google Maps</a>
                </div>
            </div>
            <div class="col-md-4">
    <div class="card border-0 shadow-sm p-4">
        <i class="fas fa-phone fa-3x text-primary mb-3"></i>
        <h5 class="fw-bold">Hubungi Kami</h5>
        <p class="mb-3">+62 878 9152 9775</p>
        <a href="https://wa.me/6287891529775" class="btn btn-outline-primary btn-sm" target="_blank">Hubungi Kami di WhatsApp</a>
    </div>
</div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4">
                    <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold">Email Kami</h5>
                    <p class="mb-3">ilyasfachruln@gmail.com</p>
                    <a href="mailto:ilyasfachruln@gmail.com" class="btn btn-outline-primary btn-sm">Kirim Email ke Kami</a>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <h3 class="text-center mt-5">Kirimkan Pesan Anda</h3>
        <p class="text-center text-muted mb-4">Isi formulir di bawah ini untuk menghubungi kami secara langsung.</p>
        <form action="send_message.php" method="POST" class="shadow-sm p-4 bg-white rounded">
            <div class="row gy-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nama Anda</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama Anda" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email Anda</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" required>
                </div>
            </div>
            <div class="row gy-3 mt-3">
                <div class="col-12">
                    <label for="subject" class="form-label">Subjek</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Judul pesan Anda" required>
                </div>
            </div>
            <div class="row gy-3 mt-3">
                <div class="col-12">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Tuliskan pesan Anda" required></textarea>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-5">Kirim Pesan</button>
            </div>
        </form>
    </div>

    <?php if (isset($_SESSION['message_status'])): ?>
        <div class="popup <?php echo $_SESSION['status']; ?>" id="popupMessage">
            <i class="<?php echo ($_SESSION['status'] == 'success') ? 'fas fa-check-circle' : 'fas fa-times-circle'; ?>"></i>
            <p><?php echo $_SESSION['message_status']; ?></p>
            <button onclick="closePopup()">Tutup</button>
        </div>
        <?php
        unset($_SESSION['message_status']);
        unset($_SESSION['status']);
        ?>
    <?php endif; ?>

    <script>
        function closePopup() {
            document.getElementById('popupMessage').style.display = 'none';
        }

        window.onload = function() {
            const popup = document.getElementById('popupMessage');
            if (popup) {
                popup.style.display = 'block';
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
