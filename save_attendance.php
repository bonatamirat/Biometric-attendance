<?php
include 'config.php';

header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => 'Invalid request'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['employee_id'])) {
    $employee_id = intval($_POST['employee_id']);

    // Verify employee exists
    $query = "SELECT id FROM employees WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $employee_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Insert attendance record
        $clock_in = date('Y-m-d H:i:s');
        $query = "INSERT INTO attendance (employee_id, clock_in) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'is', $employee_id, $clock_in);
        if (mysqli_stmt_execute($stmt)) {
            $response = [
                'status' => 'success',
                'message' => 'Attendance recorded',
                'clock_in' => $clock_in
            ];
        } else {
            $response['message'] = 'Failed to save attendance';
        }
        mysqli_stmt_close($stmt);
    } else {
        $response['message'] = 'Employee not found';
    }
}

echo json_encode($response);
mysqli_close($conn);
?>