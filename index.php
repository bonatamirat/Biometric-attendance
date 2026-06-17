<?php
include 'config.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biometric Attendance System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
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

    <!-- Hero Slider -->
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/slide1.jpg" class="d-block w-100" alt="Modern Attendance System">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Advanced Biometric Solution</h2>
                    <p>Revolutionize your attendance tracking with our fingerprint-based system</p>
                    <a href="about.php" class="btn btn-primary btn-lg">Learn More</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/images/slide2.jpg" class="d-block w-100" alt="Easy to Use">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Simple Yet Powerful</h2>
                    <p>Intuitive interface with robust reporting capabilities</p>
                    <a href="attendance.php" class="btn btn-primary btn-lg">Try It Now</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/images/slide3.jpg" class="d-block w-100" alt="Secure System">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Secure & Reliable</h2>
                    <p>Enterprise-grade security for your attendance data</p>
                    <a href="report.php" class="btn btn-primary btn-lg">View Reports</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="alert-container"></div>
        
        <!-- Quick Stats -->
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="card stat-card text-center">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h3 class="stat-number">
                            <?php 
                            try {
                                $count = $employeesCollection->countDocuments();
                                echo number_format($count);
                            } catch (Exception $e) {
                                echo "N/A";
                            }
                            ?>
                        </h3>
                        <p class="stat-label">Registered Employees</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card text-center">
                    <div class="card-body">
                        <i class="fas fa-fingerprint fa-3x text-primary mb-3"></i>
                        <h3 class="stat-number">
                            <?php 
                            try {
                                $count = $attendanceCollection->countDocuments(['clock_in' => ['$gte' => new MongoDB\BSON\UTCDateTime(strtotime('-1 day') * 1000)]]);
                                echo number_format($count);
                            } catch (Exception $e) {
                                echo "N/A";
                            }
                            ?>
                        </h3>
                        <p class="stat-label">Today's Check-ins</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card text-center">
                    <div class="card-body">
                        <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
                        <h3 class="stat-number">
                            <?php 
                            try {
                                $count = $attendanceCollection->countDocuments();
                                echo number_format($count);
                            } catch (Exception $e) {
                                echo "N/A";
                            }
                            ?>
                        </h3>
                        <p class="stat-label">Total Records</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="row mb-5">
            <div class="col-12 text-center mb-4">
                <h2 class="section-title">System Features</h2>
                <p class="lead">Powerful tools for modern workforce management</p>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card feature-card h-100">
                    <img src="assets/images/feature1.jpg" class="card-img-top" alt="Fingerprint Scanning">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-fingerprint text-primary me-2"></i> Biometric Authentication</h4>
                        <p class="card-text">Secure, fast, and accurate employee identification using fingerprint technology.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card feature-card h-100">
                    <img src="assets/images/feature2.jpg" class="card-img-top" alt="Real-time Monitoring">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-clock text-primary me-2"></i> Real-time Tracking</h4>
                        <p class="card-text">Monitor attendance in real-time with instant clock-in/clock-out recording.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card feature-card h-100">
                    <img src="assets/images/feature3.jpg" class="card-img-top" alt="Comprehensive Reports">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-chart-pie text-primary me-2"></i> Detailed Reports</h4>
                        <p class="card-text">Generate comprehensive reports for payroll, analysis, and compliance.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3><i class="fas fa-users me-2"></i> Employees</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Fingerprint ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    try {
                                        $employees = $employeesCollection->find([], ['sort' => ['name' => 1], 'limit' => 5]);
                                        foreach ($employees as $employee) {
                                            echo "<tr>
                                                <td>" . htmlspecialchars(substr((string) $employee['_id'], 0, 8)) . "</td>
                                                <td>" . htmlspecialchars($employee['name']) . "</td>
                                                <td>" . htmlspecialchars($employee['fingerprint_id']) . "</td>
                                            </tr>";
                                        }
                                    } catch (Exception $e) {
                                        echo "<tr><td colspan='3' class='text-center'>Error fetching employees</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <a href="manage_employee.php" class="btn btn-outline-primary mt-3">View All Employees</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3><i class="fas fa-history me-2"></i> Recent Attendance</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Clock In</th>
                                        <th>Clock Out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    try {
                                        $cursor = $attendanceCollection->aggregate([
                                            ['$lookup' => [
                                                'from' => 'employees',
                                                'localField' => 'employee_id',
                                                'foreignField' => '_id',
                                                'as' => 'employee'
                                            ]],
                                            ['$unwind' => '$employee'],
                                            ['$sort' => ['clock_in' => -1]],
                                            ['$limit' => 5],
                                            ['$project' => [
                                                'name' => '$employee.name',
                                                'clock_in' => ['$dateToString' => ['format' => '%H:%M', 'date' => '$clock_in']],
                                                'clock_out' => ['$ifNull' => [
                                                    ['$dateToString' => ['format' => '%H:%M', 'date' => '$clock_out']],
                                                    'N/A'
                                                ]]
                                            ]]
                                        ]);
                                        foreach ($cursor as $row) {
                                            echo "<tr>
                                                <td>" . htmlspecialchars($row['name']) . "</td>
                                                <td>" . htmlspecialchars($row['clock_in']) . "</td>
                                                <td>" . htmlspecialchars($row['clock_out']) . "</td>
                                            </tr>";
                                        }
                                    } catch (Exception $e) {
                                        echo "<tr><td colspan='3' class='text-center'>Error fetching attendance records</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <a href="report.php" class="btn btn-outline-primary mt-3">View Full Report</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-fingerprint me-2"></i> Biometric Attendance</h5>
                    <p>Advanced fingerprint-based attendance tracking system for modern businesses.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="attendance.php" class="text-white">Attendance</a></li>
                        <li><a href="manage_employee.php" class="text-white">Manage Employees</a></li>
                        <li><a href="report.php" class="text-white">Reports</a></li>
                        <li><a href="help.php" class="text-white">Help & Support</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope me-2"></i> support@biometricattendance.com</li>
                        <li><i class="fas fa-phone me-2"></i> +251 123 456 789</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i> Addis Ababa, Ethiopia</li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> Biometric Attendance System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>