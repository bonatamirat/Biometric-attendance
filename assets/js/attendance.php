<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Biometric Attendance</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="attendance.php">Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_employee.php">Manage Employee</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="report.php">Reports</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Attendance</h1>
        <div class="alert-container"></div>
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
                                $query = "SELECT e.name, a.clock_in, a.clock_out
                                          FROM attendance a
                                          JOIN employees e ON a.employee_id = e.id
                                          ORDER BY a.clock_in DESC LIMIT 5";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $clock_out = $row['clock_out'] ? $row['clock_out'] : 'N/A';
                                    echo "<tr>
                                        <td>" . htmlspecialchars($row['name']) . "</td>
                                        <td>" . htmlspecialchars($row['clock_in']) . "</td>
                                        <td>" . htmlspecialchars($clock_out) . "</td>
                                    </tr>";
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
</body>
</html>
<?php mysqli_close($conn); ?>