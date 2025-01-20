<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Navbar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* General Styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Navbar Styles */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: black;
            border-bottom: 1px solid #333;
            padding: 10px 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar .logo {
            width: 80px;
            height: auto;
        }

        .navbar .logo-text {
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
            background: linear-gradient(90deg, #90EE90, #87CEFA);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .navbar .search-bar {
            flex-grow: 1;
            max-width: 500px;
            margin: 0 20px;
            position: relative;
        }

        .navbar .search-bar input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .navbar .search-bar input:focus {
            border-color: #e60023;
            box-shadow: 0 0 5px rgba(230, 0, 35, 0.5);
        }

        .navbar .search-bar i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #999;
            font-size: 18px;
        }

        .navbar .nav-links {
            display: flex;
            gap: 15px;
            position: relative;
        }

        .navbar .nav-links a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            font-weight: 500;
            position: relative;
            transition: color 0.3s ease;
        }

        .navbar .nav-links a:hover {
    background: linear-gradient(90deg, #90EE90, #87CEFA); /* Gradasi warna hijau muda dan biru muda */
    -webkit-background-clip: text;
    color: transparent;
}


        .navbar .nav-links a:hover::after {
            content: attr(data-tooltip); /* Display tooltip */
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #40E0D0; /* Green tosca */
            color: black;
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 5px;
            white-space: nowrap;
            opacity: 1;
            visibility: visible;
            transition: opacity 0.3s ease;
        }

        .navbar .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #40E0D0; /* Green tosca */
            color: black;
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 5px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease;
        }

        /* Add gradient effect on click */
        .navbar .nav-links a:active {
            background: linear-gradient(90deg, #90EE90, #87CEFA);
            -webkit-background-clip: text;
            color: transparent;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-wrap: wrap;
            }

            .navbar .search-bar {
                flex-grow: 1;
                order: 2;
                margin: 10px 0;
                width: 100%;
            }

            .navbar .nav-links {
                justify-content: center;
                width: 100%;
                order: 3;
            }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="logo-container">
            <img src="assets/2WJ-PL55RXSkI8rFUdX8tA-removebg-preview.png" alt="Logo" class="logo">
            <a href="index.php" class="logo-text">Quantum Vault</a>
        </div>
        <div class="nav-links">
            <a href="index.php" data-tooltip="Go to Home">Home</a>
            <a href="explore.php" data-tooltip="Explore Ideas">Explore</a>
            <a href="dashboard.php" data-tooltip="View Your Dashboard">Dashboard</a>
            <a href="profil.php" data-tooltip="Manage Your Profile">Profile</a>
            <a href="contact.php" data-tooltip="Contact Us">Contact</a>
        </div>
    </header>
</body>
</html>
