<?php
include 'config.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
	   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="assets/css/custom.css" rel="stylesheet">
	<style>
        .spinner-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
        
        .scan-spinner {
            width: 80px;
            height: 80px;
            border: 8px solid #f3f3f3;
            border-top: 8px solid #0d6efd;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .scan-text {
            color: white;
            margin-top: 15px;
            font-size: 1.2rem;
        }
    </style>
	
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
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" 
                           href="index.php">
                           <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'attendance.php' ? 'active' : ''; ?>" 
                           href="attendance.php">
                           <i class="fas fa-clock me-1"></i> Attendance
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_employee.php' ? 'active' : ''; ?>" 
                           href="manage_employee.php">
                           <i class="fas fa-users me-1"></i> Employees
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'report.php' ? 'active' : ''; ?>" 
                           href="report.php">
                           <i class="fas fa-chart-bar me-1"></i> Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_admin.php' ? 'active' : ''; ?>" 
                           href="manage_admin.php">
                           <i class="fas fa-user-cog me-1"></i> Admins
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>" 
                           href="about.php">
                           <i class="fas fa-info-circle me-1"></i> About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'help.php' ? 'active' : ''; ?>" 
                           href="help.php">
                           <i class="fas fa-question-circle me-1"></i> Help
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                           <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5 pt-4">
	<div class="alert-container"></div>
        <h1 class="text-center mb-4">Attendance</h1>
        
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">Mark Attendance</div>
                    <div class="card-body">
                        <form class="ajax-form" id="attendance-form">
                            <input type="hidden" name="action" value="attendance">
                            <button type="submit" class="btn btn-success">Scan Fingerprint</button>
                            <div class="spinner-border text-success spinner" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">Recent Attendance</div>
                    <div class="card-body">
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
                                            'clock_in' => ['$dateToString' => ['format' => '%Y-%m-%d %H:%M:%S', 'date' => '$clock_in']],
                                            'clock_out' => ['$ifNull' => [
                                                ['$dateToString' => ['format' => '%Y-%m-%d %H:%M:%S', 'date' => '$clock_out']],
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
                                    echo "<tr><td colspan='3'>Error fetching attendance records</td></tr>";
                                    error_log("Recent Attendance: MongoDB error: " . $e->getMessage());
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="assets/js/custom.js"></script>
	<script>
    $(document).ready(function() {
        // Handle attendance form submission
        $('#attendance-form').on('submit', function(e) {
            e.preventDefault();
            
            // Show loading overlay
            $('#loadingOverlay').css('display', 'flex');
            $('#scanButton').prop('disabled', true);
            
            $.ajax({
                url: 'api.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    // Hide loading overlay
                    $('#loadingOverlay').hide();
                    $('#scanButton').prop('disabled', false);
                    
                    // Show alert
                    const alertType = response.status === 'success' ? 'success' : 'danger';
                    $('.alert-container').html(`
                        <div class="alert alert-${alertType} alert-dismissible fade show" role="alert">
                            ${response.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                    
                    // Reload recent attendance if successful
                    if(response.status === 'success') {
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }
                },
                error: function(xhr, status, error) {
                    // Hide loading overlay on error
                    $('#loadingOverlay').hide();
                    $('#scanButton').prop('disabled', false);
                    
                    $('.alert-container').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Failed to communicate with server: ${error || 'Unknown error'}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                },
                timeout: 30000 // 30 seconds timeout
            });
        });
    });
    </script>
</body>
</html>