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
    <title>About - Graphical Password Authentication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1c2c, #4a1942);
            color: white;
            font-family: 'Poppins', sans-serif;
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

        .about-header {
            background-image: url('Gr2.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            padding: 100px 0;
            margin-bottom: 4rem;
        }

        .about-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
        }

        .about-header-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .about-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .how-it-works-container {
            display: flex;
            gap: 4rem;
            align-items: flex-start;
        }

        .how-it-works-list {
            flex: 1;
        }

        .how-it-works-list h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: white;
        }

        .work-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .work-item:hover {
            transform: translateY(-5px);
        }

        .why-choose-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .why-choose-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 1.5rem;
            transition: transform 0.3s ease;
        }

        .why-choose-item:hover {
            transform: translateY(-5px);
        }

        .timeline {
            position: relative;
            padding: 2rem 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            width: 2px;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-50%);
        }

        .timeline-item {
            margin-bottom: 3rem;
            position: relative;
        }

        .timeline-content {
            width: calc(50% - 30px);
            padding: 1.5rem;
            position: relative;
        }

        .timeline-item:nth-child(odd) .timeline-content {
            margin-left: auto;
        }

        .timeline-item .timeline-content::before {
            content: '';
            position: absolute;
            top: 20px;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
        }

        .timeline-item:nth-child(odd) .timeline-content::before {
            left: -40px;
        }

        .timeline-item:nth-child(even) .timeline-content::before {
            right: -40px;
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

        @media (max-width: 991px) {
            .how-it-works-container {
                flex-direction: column;
                gap: 2rem;
            }
        }

        @media (max-width: 768px) {
            .timeline::before {
                left: 40px;
            }

            .timeline-content {
                width: calc(100% - 60px);
                margin-left: 60px !important;
            }

            .timeline-item .timeline-content::before {
                left: -40px !important;
            }
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
                        <a class="nav-link active" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
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

    <!-- About Header -->
    <header class="about-header">
        <div class="about-header-content">
            <div class="container">
                <h1 class="about-title">About Us</h1>
                <p class="lead">Revolutionizing authentication through visual patterns</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <!-- Our Story -->
        <section class="glass-card">
            <h2 class="mb-4">Our Story</h2>
            <p>The Graphical Password Authentication System represents a revolutionary approach to online security. Born from the need to create more secure yet user-friendly authentication methods, our system leverages the human brain's remarkable ability to remember visual patterns.</p>
            <p>Unlike traditional password systems that rely on complex combinations of characters, our pattern-based approach offers enhanced security while being significantly easier to remember.</p>
        </section>

        <!-- How It Works -->
        <section class="glass-card">
            <div class="how-it-works-container">
                <div class="how-it-works-list">
                    <h2>How It Works</h2>
                    <div class="work-item">
                        <h3>1. Pattern Selection</h3>
                        <p>• Users create their unique pattern by connecting dots in a sequence they can easily remember.</p>
                    </div>
                    <div class="work-item">
                        <h3>2. Secure Storage</h3>
                        <p>• The pattern is encrypted and securely stored in our database.</p>
                    </div>
                    <div class="work-item">
                        <h3>3. Authentication</h3>
                        <p>• During login, users recreate their pattern to gain access to their account.</p>
                    </div>
                </div>

                <div class="how-it-works-list">
                    <h2>Why Choose Graphical Passwords?</h2>
                    <div class="why-choose-container">
                        <div class="why-choose-item">
                            <h3>Higher Security</h3>
                            <p>Harder to crack than text passwords and resistant to brute-force attacks.</p>
                        </div>
                        <div class="why-choose-item">
                            <h3>Easy to Remember</h3>
                            <p>Users recall visual patterns faster than alphanumeric passwords.</p>
                        </div>
                        <div class="why-choose-item">
                            <h3>Faster Login</h3>
                            <p>Enter your password with a few simple swipes instead of typing long passwords.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
