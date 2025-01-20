<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Footer Styles */
        #footer {
            background-color: #333; /* Dark background */
            color: #fff; /* White text */
            padding: 40px 0;
            font-size: 14px;
            text-align: center;
        }

        #footer .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Copyright Section */
        #footer .copyright p {
            margin: 0;
            font-size: 14px;
            color: #ccc;
        }

        #footer .copyright .sitename {
            font-weight: bold;
            background: linear-gradient(90deg, #90EE90, #87CEFA); /* Gradasi hijau muda ke biru muda */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Social Links Section */
        #footer .social-links {
            margin: 20px 0;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        #footer .social-links a {
            font-size: 24px;
            color: #ccc;
            transition: color 0.3s ease, background-image 0.3s ease;
        }

        #footer .social-links a:hover {
            background: linear-gradient(90deg, #90EE90, #87CEFA); /* Gradasi hijau muda ke biru muda */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        #footer .social-links a:active {
            background: linear-gradient(90deg, #90EE90, #87CEFA);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Credits Section */
        #footer .credits {
            font-size: 12px;
            margin-top: 20px;
        }

        #footer .credits a {
            background: linear-gradient(90deg, #90EE90, #87CEFA); /* Gradasi hijau muda ke biru muda */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
            transition: text-shadow 0.3s ease, opacity 0.3s ease;
        }

        #footer .credits a:hover {
            text-shadow: 0 0 5px rgba(144, 238, 144, 0.7), 0 0 10px rgba(135, 206, 250, 0.7);
            opacity: 0.8;
        }

        /* Accent Background */
        .accent-background {
            background-color: #222; /* Slightly darker background for contrast */
        }
    </style>
</head>
<body>

    <footer id="footer" class="footer accent-background">
        <div class="container">
            <div class="copyright text-center">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">Quantum Vault</strong> <span>All Rights Reserved</span></p>
            </div>
            <div class="social-links d-flex justify-content-center">
                <!-- Twitter Icon -->
                <a href="https://twitter.com" target="_blank"><i class="bi bi-twitter"></i> Twitter</a>

                <!-- Facebook Icon -->
                <a href="https://facebook.com" target="_blank"><i class="bi bi-facebook"></i> Facebook</a>

                <!-- Instagram Icon -->
                <a href="https://instagram.com" target="_blank"><i class="bi bi-instagram"></i> Instagram</a>

                <!-- LinkedIn Icon -->
                <a href="https://linkedin.com" target="_blank"><i class="bi bi-linkedin"></i> LinkedIn</a>
            </div>
            <div class="credits">
                Designed by <a href="https://www.instagram.com/ilyasfachrulnizwan_29?igsh=bTlkYXRrN2Z0YWpl" target="_blank">Ilyas Fachrul Nizwan</a>
            </div>
        </div>
    </footer>

</body>
</html>
