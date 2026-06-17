<?php
include 'config.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center - Biometric Attendance</title>
	   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
    <header class="help-hero bg-primary text-white py-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Help Center</h1>
            <p class="lead">Find answers to your questions and get the most out of BioTrack</p>
            <div class="search-box mx-auto mt-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search help articles...">
                    <button class="btn btn-light" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-5">
        <!-- Getting Started -->
        <section class="mb-5">
            <h2 class="mb-4 fw-bold text-primary"><i class="bi bi-rocket me-2"></i>Getting Started</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-box-seam text-primary fs-4"></i>
                                </div>
                                <h3 class="h5 mb-0">Hardware Setup</h3>
                            </div>
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item border-0 ps-0">Connect fingerprint scanner to ESP8266 module</li>
                                <li class="list-group-item border-0 ps-0">Power the device with 5V power supply</li>
                                <li class="list-group-item border-0 ps-0">Configure WiFi settings for your network</li>
                                <li class="list-group-item border-0 ps-0">Verify IP address in system configuration</li>
                                <li class="list-group-item border-0 ps-0">Test connection with the web interface</li>
                            </ol>
                            <div class="mt-3">
                                <img src="assets/images/hardware-setup.jpg" class="img-fluid rounded" alt="Hardware Setup">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-laptop text-primary fs-4"></i>
                                </div>
                                <h3 class="h5 mb-0">Software Configuration</h3>
                            </div>
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item border-0 ps-0">Log in to the admin dashboard</li>
                                <li class="list-group-item border-0 ps-0">Configure system settings</li>
                                <li class="list-group-item border-0 ps-0">Add administrator accounts</li>
                                <li class="list-group-item border-0 ps-0">Set up employee database</li>
                                <li class="list-group-item border-0 ps-0">Test the attendance system</li>
                            </ol>
                            <div class="mt-3">
                                <img src="assets/images/software-config.jpg" class="img-fluid rounded" alt="Software Configuration">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- User Guides -->
        <section class="mb-5">
            <h2 class="mb-4 fw-bold text-primary"><i class="bi bi-journal-bookmark me-2"></i>User Guides</h2>
            <div class="accordion" id="userGuidesAccordion">
                <!-- Guide 1 -->
                <div class="accordion-item border-0 shadow-sm mb-3 rounded">
                    <h2 class="accordion-header">
                        <button class="accordion-button bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#guide1">
                            <i class="bi bi-person-plus me-2 text-primary"></i>Enrolling Employees
                        </button>
                    </h2>
                    <div id="guide1" class="accordion-collapse collapse show" data-bs-parent="#userGuidesAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="h6">Steps to enroll employees:</h4>
                                    <ol>
                                        <li>Navigate to <strong>Manage Employees</strong></li>
                                        <li>Click <strong>Enroll Employee</strong></li>
                                        <li>Enter employee details (Name, Fingerprint ID)</li>
                                        <li>Click <strong>Enroll</strong> button</li>
                                        <li>Have the employee scan their fingerprint</li>
                                        <li>Confirm successful enrollment</li>
                                    </ol>
                                </div>
                                <div class="col-md-6">
                                    <img src="assets/images/enroll-process.jpg" class="img-fluid rounded" alt="Enrollment Process">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Guide 2 -->
                <div class="accordion-item border-0 shadow-sm mb-3 rounded">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#guide2">
                            <i class="bi bi-clock me-2 text-primary"></i>Recording Attendance
                        </button>
                    </h2>
                    <div id="guide2" class="accordion-collapse collapse" data-bs-parent="#userGuidesAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="h6">Recording attendance:</h4>
                                    <ol>
                                        <li>Go to <strong>Attendance</strong> page</li>
                                        <li>Click <strong>Scan Fingerprint</strong></li>
                                        <li>Employee scans their fingerprint</li>
                                        <li>System automatically clocks in/out</li>
                                        <li>View confirmation message</li>
                                    </ol>
                                    <p class="mt-3"><strong>Note:</strong> First scan = Clock In, Second scan = Clock Out</p>
                                </div>
                                <div class="col-md-6">
                                    <img src="assets/images/attendance-process.jpg" class="img-fluid rounded" alt="Attendance Process">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Guide 3 -->
                <div class="accordion-item border-0 shadow-sm mb-3 rounded">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#guide3">
                            <i class="bi bi-file-earmark-bar-graph me-2 text-primary"></i>Generating Reports
                        </button>
                    </h2>
                    <div id="guide3" class="accordion-collapse collapse" data-bs-parent="#userGuidesAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="h6">Creating reports:</h4>
                                    <ol>
                                        <li>Navigate to <strong>Reports</strong></li>
                                        <li>Select date range</li>
                                        <li>Filter by employee (optional)</li>
                                        <li>Click <strong>Generate Report</strong></li>
                                        <li>View or export the report</li>
                                    </ol>
                                    <div class="mt-3">
                                        <h5 class="h6">Report Types:</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Daily Attendance</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Monthly Summary</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Employee History</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img src="assets/images/report-example.jpg" class="img-fluid rounded" alt="Report Example">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Troubleshooting -->
        <section class="mb-5">
            <h2 class="mb-4 fw-bold text-primary"><i class="bi bi-tools me-2"></i>Troubleshooting</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-danger bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-exclamation-triangle text-danger fs-4"></i>
                                </div>
                                <h3 class="h5 mb-0">Common Issues</h3>
                            </div>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item border-0 px-0">
                                    <h4 class="h6 text-danger">Fingerprint not recognized</h4>
                                    <p>Solution: Clean the scanner surface and ensure proper finger placement. Re-enroll if necessary.</p>
                                </div>
                                <div class="list-group-item border-0 px-0">
                                    <h4 class="h6 text-danger">Device not connecting</h4>
                                    <p>Solution: Check power supply, WiFi connection, and verify IP address settings.</p>
                                </div>
                                <div class="list-group-item border-0 px-0">
                                    <h4 class="h6 text-danger">Attendance not recording</h4>
                                    <p>Solution: Verify database connection and check server logs for errors.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-headset text-primary fs-4"></i>
                                </div>
                                <h3 class="h5 mb-0">Contact Support</h3>
                            </div>
                            <div class="support-contact">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-light p-2 rounded me-3">
                                        <i class="bi bi-envelope text-primary"></i>
                                    </div>
                                    <div>
                                        <h4 class="h6 mb-0">Email Support</h4>
                                        <p class="mb-0 text-muted">support@biotrack.com</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-light p-2 rounded me-3">
                                        <i class="bi bi-telephone text-primary"></i>
                                    </div>
                                    <div>
                                        <h4 class="h6 mb-0">Phone Support</h4>
                                        <p class="mb-0 text-muted">+251 123 456 789</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="bg-light p-2 rounded me-3">
                                        <i class="bi bi-clock text-primary"></i>
                                    </div>
                                    <div>
                                        <h4 class="h6 mb-0">Support Hours</h4>
                                        <p class="mb-0 text-muted">Monday-Friday, 8:00 AM - 5:00 PM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-primary w-100">
                                    <i class="bi bi-chat-left-text me-2"></i>Live Chat
                                </button>
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
                <small>&copy; 2023 BioTrack. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>