<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-image: url('assets/2025011921000917.jpg'); /* Default background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            transition: background-image 0.5s ease-in-out;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-form h2 {
            font-size: 28px;
            margin-bottom: 25px;
            background: linear-gradient(to right, #90ee90, #87cefa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
            text-align: left;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 14px;
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            background: linear-gradient(to right, #90ee90, #87cefa);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .btn:hover {
            transform: scale(1.03);
        }

        .text-center {
            text-align: center;
        }

        .text-center a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .text-center a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .mt-3 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Login</h2>
            <form action="ceklogin.php" method="POST">
                <label for="Username" class="form-label">Username</label>
                <div class="input-group">
                    <input type="text" name="Username" class="form-control" id="Username" placeholder="Masukkan username" required>
                </div>
                <label for="Password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="Password" class="form-control" id="Password" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <p class="mt-3 text-center">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>
