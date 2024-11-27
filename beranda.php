<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to the login page
    header("Location: formlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Teropong Alam</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts for aesthetic fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #a1c4fd, #c2e9fb); /* Soft gradient background */
            font-family: 'Roboto', sans-serif; /* Clean, minimal font */
        }
        .navbar-custom {
            background-color: #007bff;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white;
        }
        .container {
            margin-top: 50px;
        }
        .welcome-text {
            color: transparent;
            background-image: linear-gradient(to right, #a2a2f1, #ff8aff); /* Purple to soft pink gradient */
            -webkit-background-clip: text;
            font-family: 'Playfair Display', serif; /* Elegant and minimal serif font */
            font-weight: 500;
            font-size: 2.8rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1), 0 0 10px rgba(255, 255, 255, 0.2); /* Soft, subtle shadow */
            animation: fadeInUp 1.5s ease-out; /* Fade-in + slide-up animation */
        }
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .lead {
            font-family: 'Roboto', sans-serif;
            font-weight: 400;
            font-size: 1.25rem;
            color: #6c757d;
            margin-bottom: 30px;
        }
        .card-custom {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            opacity: 0;
            animation: slideInUp 1.5s forwards;
        }
        @keyframes slideInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .card-body {
            text-align: center;
            padding: 30px;
        }
        .btn-primary {
            font-weight: 600;
            padding: 10px 20px;
            font-size: 1rem;
            color: white;
            transition: all 0.3s ease-in-out;
            border: none;
            margin-bottom: 10px;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            scale: 1.05; /* Slight scale-up effect on hover */
        }
        /* Different colors for each button */
        .btn-tampil1 {
            background-color: #007bff;
        }
        .btn-tampil2 {
            background-color: #add8e6; /* Light blue for Tampil2 */
        }
        .btn-tampil3 {
            background-color: #c8a2c8; /* Lilac for Tampil3 */
        }
        /* Hover effects for different colors */
        .btn-tampil1:hover {
            background-color: #0056b3;
        }
        .btn-tampil2:hover {
            background-color: #87ceeb; /* Lighter blue on hover */
        }
        .btn-tampil3:hover {
            background-color: #b897c7; /* Lighter lilac on hover */
        }
    </style>
</head>
<body>
    <!-- Navbar with custom blue color -->
    <nav class="navbar navbar-expand-lg navbar-custom navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Teropong Alam</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container text-center">
        <h1 class="welcome-text">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <p class="lead">You're successfully logged in.</p>

        <!-- Card layout for navigation buttons -->
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card-custom">
                    <div class="card-body">
                        <a href="tampil1.php" class="btn btn-tampil1 w-100">REGISTRASI</a>
                    </div>
                </div>
                <div class="card-custom">
                    <div class="card-body">
                        <a href="tampil2.php" class="btn btn-tampil2 w-100">OUTDOOR GEAR</a>
                    </div>
                </div>
                <div class="card-custom">
                    <div class="card-body">
                        <a href="tampil3.php" class="btn btn-tampil3 w-100">INFORMASI</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (for responsive navbar toggle) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
