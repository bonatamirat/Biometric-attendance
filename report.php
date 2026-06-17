<?php
include 'config.php';
requireLogin();

$start_date = $_GET['start_date'] ?? date('Y-m-d', strtotime('-7 days'));
$end_date = $_GET['end_date'] ?? date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report</title>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
</head>
<body>
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
        <h1 class="text-center mb-4">Attendance Report</h1>
        <div class="alert-container"></div>
        <div class="card">
            <div class="card-header">Filter Attendance</div>
            <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="<?php echo htmlspecialchars($start_date); ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control" value="<?php echo htmlspecialchars($end_date); ?>">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">Attendance Records</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Clock In</th>
                            <th>Clock Out</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        try {
                            $start = new \MongoDB\BSON\UTCDateTime(new DateTime($start_date . ' 00:00:00'));
                            $end = new \MongoDB\BSON\UTCDateTime(new DateTime($end_date . ' 23:59:59'));
                            $cursor = $attendanceCollection->aggregate([
                                ['$match' => [
                                    'clock_in' => ['$gte' => $start, '$lte' => $end]
                                ]],
                                ['$lookup' => [
                                    'from' => 'employees',
                                    'localField' => 'employee_id',
                                    'foreignField' => '_id',
                                    'as' => 'employee'
                                ]],
                                ['$unwind' => '$employee'],
                                ['$sort' => ['clock_in' => -1]],
                                ['$project' => [
                                    '_id' => 1,
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
                                    <td>
                                        <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteAttendanceModal'
                                            data-attendance-id='" . htmlspecialchars((string) $row['_id']) . "' data-employee-name='" . htmlspecialchars($row['name']) . "'>Delete</button>
                                    </td>
                                </tr>";
                            }
                        } catch (Exception $e) {
                            echo "<tr><td colspan='4'>Error fetching attendance records</td></tr>";
                            error_log("Attendance Report: MongoDB error: " . $e->getMessage());
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteAttendanceModal" tabindex="-1" aria-labelledby="deleteAttendanceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAttendanceModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the attendance record for <strong id="employeeName"></strong>?
                </div>
                <div class="modal-footer">
                    <form class="ajax-form" id="delete-attendance-form">
                        <input type="hidden" name="action" value="delete_attendance">
                        <input type="hidden" name="attendance_id" id="deleteAttendanceId">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <div class="spinner-border text-danger spinner" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>