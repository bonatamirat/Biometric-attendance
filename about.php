<?php
include 'config.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Biometric Attendance</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-fingerprint me-2"></i>Biometric Attendance
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fas fa-home me-1"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="attendance.php"><i class="fas fa-clock me-1"></i> Attendance</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage_employee.php"><i class="fas fa-users me-1"></i> Employees</a></li>
                    <li class="nav-item"><a class="nav-link" href="report.php"><i class="fas fa-chart-bar me-1"></i> Reports</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage_admin.php"><i class="fas fa-user-cog me-1"></i> Admins</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php"><i class="fas fa-info-circle me-1"></i> About</a></li>
                    <li class="nav-item"><a class="nav-link" href="help.php"><i class="fas fa-question-circle me-1"></i> Help</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt me-1"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
 <div class="container mt-5 pt-4">
        <div class="alert-container"></div>
    <!-- Hero Section -->
    <header class="hero-section bg-primary text-white py-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Meet Our Team</h1>
            <p class="lead">The brilliant minds behind the BioTrack Attendance System</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-5">
        <!-- Project Showcase Carousel -->
        <section class="mb-5">
            <div id="projectCarousel" class="carousel slide shadow-lg rounded-3" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#projectCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#projectCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#projectCarousel" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner rounded-3">
                    <div class="carousel-item active">
                        <img src="assets/images/project-showcase-1.jpg" class="d-block w-100" alt="System Overview">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded-3 p-3">
                            <h5>Comprehensive Attendance Solution</h5>
                            <p>Seamlessly track employee attendance with fingerprint authentication</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/project-showcase-2.jpg" class="d-block w-100" alt="Hardware Setup">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded-3 p-3">
                            <h5>Advanced Hardware Integration</h5>
                            <p>Reliable fingerprint scanning with ESP8266 connectivity</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/project-showcase-3.jpg" class="d-block w-100" alt="Software Interface">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded-3 p-3">
                            <h5>Intuitive Web Interface</h5>
                            <p>Easy-to-use dashboard for attendance management</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#projectCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#projectCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </section>

        <!-- Team Section -->
       <!-- Team Section -->
<section class="mb-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Meet Our Team</h2>
        <p class="lead text-center mb-5">The brilliant minds behind the BioTrack Attendance System</p>
        
        <div class="row g-4 justify-content-center">
            <!-- Team Member 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="assets/images/bona-tamirat.jpg" class="card-img-top" alt="Bona Tamirat">
                    <div class="card-body text-center">
                        <h3 class="h5">Bona Tamirat</h3>
                        <p class="text-muted mb-3">Project Lead</p>
                        <p class="card-text">Oversees system architecture and full-stack development.</p>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="assets/images/garoma-wakjira.jpg" class="card-img-top" alt="Garoma Wakjira">
                    <div class="card-body text-center">
                        <h3 class="h5">Garoma Wakjira</h3>
                        <p class="text-muted mb-3">Hardware Specialist</p>
                        <p class="card-text">Designs and implements fingerprint hardware integration.</p>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="assets/images/muluken-teshome.jpg" class="card-img-top" alt="Muluken Teshome">
                    <div class="card-body text-center">
                        <h3 class="h5">Muluken Teshome</h3>
                        <p class="text-muted mb-3">Database Architect</p>
                        <p class="card-text">Optimizes MongoDB performance and data security.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        <!-- Project Description -->
        <section class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-primary text-white">
                <h2 class="h4 mb-0">About BioTrack</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="h5 text-primary">Our Mission</h3>
                        <p>BioTrack was developed to revolutionize attendance tracking by eliminating manual processes and providing accurate, tamper-proof records through biometric authentication.</p>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span>Secure fingerprint authentication</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span>Real-time attendance monitoring</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span>Comprehensive reporting</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="h5 text-primary">Technology Stack</h3>
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="tech-badge p-2 rounded bg-light">
                                    <i class="bi bi-cpu me-2 text-primary"></i>ESP8266
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="tech-badge p-2 rounded bg-light">
                                    <i class="bi bi-fingerprint me-2 text-primary"></i>FPM10A
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="tech-badge p-2 rounded bg-light">
                                    <i class="bi bi-database me-2 text-primary"></i>MongoDB
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="tech-badge p-2 rounded bg-light">
                                    <i class="bi bi-code-square me-2 text-primary"></i>PHP
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="tech-badge p-2 rounded bg-light">
                                    <i class="bi bi-bootstrap me-2 text-primary"></i>Bootstrap 5
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="tech-badge p-2 rounded bg-light">
                                    <i class="bi bi-wifi me-2 text-primary"></i>WiFi
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="h5">BioTrack</h3>
                    <p>Advanced biometric attendance tracking system for modern organizations.</p>
                </div>
                <div class="col-md-3">
                    <h3 class="h5">Quick Links</h3>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white-50">Home</a></li>
                        <li><a href="about.php" class="text-white-50">About</a></li>
                        <li><a href="help.php" class="text-white-50">Help</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h3 class="h5">Contact</h3>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-envelope me-2"></i> info@biotrack.com</li>
                        <li><i class="bi bi-telephone me-2"></i> +251 123 456 789</li>
                    </ul>
                </div>
            </div>
            <hr class="my-3 bg-secondary">
            <div class="text-center text-white-50">
                <small>&copy; 2025 BioTrack. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>