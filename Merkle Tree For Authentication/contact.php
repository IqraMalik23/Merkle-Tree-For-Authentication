<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Graphical Password Authentication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1c2c, #4a1942);
            color: white;
            font-family: 'Poppins', sans-serif;
            padding-top: 76px;
        }

        .navbar {
            background: rgba(0, 0, 0, 0.3) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            transition: transform 0.3s ease;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: white !important;
            transform: translateY(-2px);
        }

        .logout-btn {
            border: none;
            background: rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            border-radius: 20px;
            padding: 0.5rem 1.5rem;
            color: white;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }

        .contact-header {
            background-image: url('Gr2.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            height: 40vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: -76px;
            margin-bottom: 3rem;
        }

        .contact-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
        }

        .contact-header-content {
            position: relative;
            z-index: 1;
            color: white;
        }

        .contact-title {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .contact-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.8rem;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
            box-shadow: none;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .submit-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .contact-info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .info-item {
            text-align: center;
        }

        .info-item h3 {
            margin: 1rem 0 0.5rem;
            font-size: 1.2rem;
        }

        .info-item p {
            margin: 0;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .contact-icon {
            font-size: 2rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .footer {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 3rem 0;
            margin-top: 4rem;
        }

        .social-icons {
            font-size: 1.5rem;
        }

        .social-icons a {
            color: white;
            margin: 0 10px;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            transform: translateY(-3px);
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="logo.jpeg" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
                Graphical Auth
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="contact.php">Contact</a>
                    </li>
                </ul>
                <form action="logout.php" method="POST" class="ms-3">
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Contact Header -->
    <header class="contact-header">
        <div class="contact-header-content">
            <div class="container">
                <h1 class="contact-title">Contact Us</h1>
                <p class="contact-subtitle">Get in touch with our team</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <div class="row justify-content-between">
            <!-- Contact Form -->
            <div class="col-lg-6 mb-4">
                <div class="glass-card">
                    <h2 class="mb-4">Send us a Message</h2>
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Subject" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="5" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="submit-btn">Send Message</button>
                    </form>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-5">
                <div class="glass-card">
                    <h2 class="mb-4">Contact Information</h2>
                    <div class="contact-info-grid">
                        <div class="info-item">
                            <i class="bi bi-geo-alt contact-icon"></i>
                            <h3>Address</h3>
                            <p>123 Security Street<br>Tech Valley, CA 94043</p>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-telephone contact-icon"></i>
                            <h3>Phone</h3>
                            <p>+1 (234) 567-890<br>+1 (234) 567-891</p>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-envelope contact-icon"></i>
                            <h3>Email</h3>
                            <p>info@graphicalauth.com<br>support@graphicalauth.com</p>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-clock contact-icon"></i>
                            <h3>Working Hours</h3>
                            <p>Monday - Friday<br>9:00 AM - 6:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contact Info</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="mailto:info@graphicalauth.com">info@graphicalauth.com</a></li>
                        <li class="nav-item"><a class="nav-link" href="tel:+1234567890">+1 (234) 567-890</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Follow Us</h5>
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Prevent going back to login page after logout
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function() {
            window.history.pushState(null, null, window.location.href);
        };
    </script>
</body>
</html>
