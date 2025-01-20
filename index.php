<?php
session_start(); // Start the session to access session variables

// Check if the session variable 'Username' is set (i.e., the user is logged in)
if (isset($_SESSION['Username'])) {
    $username = $_SESSION['Username']; // Get the username from the session
} else {
    $username = "Guest"; // Fallback if the user is not logged in
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ilyas29 Home</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('assets/2025011921000917.jpg') no-repeat center center fixed; /* Ganti dengan path gambar latar belakang */
            background-size: cover;
            color: #fff;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4); /* Overlay hitam transparan */
            filter: blur(50px); /* Blur pada background */
            z-index: -1;
        }

        header {
            background-color: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid #e2e2e2;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        header .logo {
            font-size: 24px;
            font-weight: bold;
            color: #e60023;
            text-decoration: none;
        }

        header .search-bar {
            flex: 1;
            margin: 0 20px;
        }

        header .search-bar input {
            width: 100%;
            padding: 10px;
            border: 1px solid #e2e2e2;
            border-radius: 20px;
            outline: none;
        }

        header .nav-links {
            display: flex;
            gap: 15px;
        }

        header .nav-links a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
        }

        .welcome-section {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5); /* Overlay gelap pada teks */
        }

        .welcome-section h1 {
            font-size: 48px;
            margin: 0;
        }

        .welcome-section .typing-text {
            font-size: 24px;
            margin-top: 10px;
            font-weight: 300;
            white-space: nowrap;
            overflow: hidden;
            border-right: 3px solid #fff;
            width: 0;
            animation: blink 0.5s step-end infinite alternate;
        }

        @keyframes blink {
            from {
                border-right-color: transparent;
            }
            to {
                border-right-color: #fff;
            }
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>


    <!-- Welcome Section -->
    <div class="welcome-section">
        <h1>Selamat Datang, <?php echo htmlspecialchars($username); ?>!</h1>
        <div class="typing-text" id="typing-text"></div>
    </div>

    <script>
        // Array of texts to display
        const texts = ["Nikmati pengalaman terbaik di website kami...", "Layanan kami cepat dan terpercaya.", "Hubungi kami untuk informasi lebih lanjut."];
        let currentTextIndex = 0;
        let charIndex = 0;
        const typingSpeed = 100; // Speed of typing
        const erasingSpeed = 50; // Speed of erasing
        const delayBetweenTexts = 2000; // Delay before typing the next text
        const typingTextElement = document.getElementById("typing-text");

        function type() {
            if (charIndex < texts[currentTextIndex].length) {
                typingTextElement.textContent += texts[currentTextIndex].charAt(charIndex);
                charIndex++;
                setTimeout(type, typingSpeed);
            } else {
                setTimeout(erase, delayBetweenTexts);
            }
        }

        function erase() {
            if (charIndex > 0) {
                typingTextElement.textContent = texts[currentTextIndex].substring(0, charIndex - 1);
                charIndex--;
                setTimeout(erase, erasingSpeed);
            } else {
                currentTextIndex = (currentTextIndex + 1) % texts.length;
                setTimeout(type, typingSpeed);
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            setTimeout(type, delayBetweenTexts); // Start typing after initial delay
        });

    </script>
    <?php include "footer.php"; ?>
</body>
</html>
