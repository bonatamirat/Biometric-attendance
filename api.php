<?php
include 'config.php';

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');

ob_start();
$response = ['status' => 'error', 'message' => 'Invalid action'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $post_data = ['action' => $action];

    switch ($action) {
        case 'enroll':
            if (!isset($_POST['name']) || !isset($_POST['fingerprint_id'])) {
                $response = ['status' => 'error', 'message' => 'Missing name or fingerprint_id'];
                break;
            }
            $name = trim($_POST['name']);
            $fingerprint_id = (int)$_POST['fingerprint_id'];
            $post_data['name'] = $name;
            $post_data['fingerprint_id'] = $fingerprint_id;

            try {
                if ($employeesCollection->findOne(['fingerprint_id' => $fingerprint_id])) {
                    $response = ['status' => 'error', 'message' => 'Fingerprint ID already exists'];
                    break;
                }
                $ch = curl_init("http://$esp8266_ip/control");
                curl_setopt_array($ch, [
                    CURLOPT_POST => 1,
                    CURLOPT_POSTFIELDS => http_build_query($post_data),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 60
                ]);
                $curl_response = curl_exec($ch);
                if ($curl_response === false) {
                    $response = ['status' => 'error', 'message' => 'ESP8266 communication failed'];
                    error_log("Enroll: ESP8266 error: " . curl_error($ch));
                } else {
                    $result = json_decode($curl_response, true);
                    if (is_array($result) && isset($result['status']) && $result['status'] == 'success') {
                        $employeesCollection->insertOne([
                            'name' => $name,
                            'fingerprint_id' => $fingerprint_id
                        ]);
                        $response = ['status' => 'success', 'message' => $result['message']];
                    } else {
                        $response = ['status' => 'error', 'message' => $result['message'] ?? 'Invalid ESP8266 response'];
                    }
                }
                curl_close($ch);
            } catch (Exception $e) {
                $response = ['status' => 'error', 'message' => 'Database error'];
                error_log("Enroll: MongoDB error: " . $e->getMessage());
            }
            break;

        case 'attendance':
            $ch = curl_init("http://$esp8266_ip/control");
            curl_setopt_array($ch, [
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => http_build_query($post_data),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 60
            ]);
            $curl_response = curl_exec($ch);
            if ($curl_response === false) {
                $response = ['status' => 'error', 'message' => 'ESP8266 communication failed'];
                error_log("Attendance: ESP8266 error: " . curl_error($ch));
            } else {
                $result = json_decode($curl_response, true);
                if (is_array($result) && isset($result['status']) && $result['status'] == 'success') {
                    $fingerprint_id = (int)$result['message'];
                    try {
                        $employee = $employeesCollection->findOne(['fingerprint_id' => $fingerprint_id]);
                        if (!$employee) {
                            $response = ['status' => 'error', 'message' => 'Employee not found'];
                            break;
                        }
                        $employee_id = $employee['_id'];
                        $clock_in = new \MongoDB\BSON\UTCDateTime();
                        $latestAttendance = $attendanceCollection->findOne(
                            ['employee_id' => $employee_id, 'clock_out' => null],
                            ['sort' => ['clock_in' => -1]]
                        );
                        if ($latestAttendance) {
                            $attendanceCollection->updateOne(
                                ['_id' => $latestAttendance['_id']],
                                ['$set' => ['clock_out' => new \MongoDB\BSON\UTCDateTime()]]
                            );
                            $response = ['status' => 'success', 'message' => 'Clocked out for ID #' . $fingerprint_id];
                        } else {
                            $attendanceCollection->insertOne([
                                'employee_id' => $employee_id,
                                'clock_in' => $clock_in,
                                'clock_out' => null
                            ]);
                            $response = ['status' => 'success', 'message' => 'Clocked in for ID #' . $fingerprint_id];
                        }
                    } catch (Exception $e) {
                        $response = ['status' => 'error', 'message' => 'Database error'];
                        error_log("Attendance: MongoDB error: " . $e->getMessage());
                    }
                } else {
                    $response = ['status' => 'error', 'message' => $result['message'] ?? 'Invalid ESP8266 response'];
                }
            }
            curl_close($ch);
            break;

        case 'delete':
            if (!isset($_POST['fingerprint_id'])) {
                $response = ['status' => 'error', 'message' => 'Missing fingerprint_id'];
                break;
            }
            $fingerprint_id = (int)$_POST['fingerprint_id'];
            $post_data['fingerprint_id'] = $fingerprint_id;

            $ch = curl_init("http://$esp8266_ip/control");
            curl_setopt_array($ch, [
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => http_build_query($post_data),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 60
            ]);
            $curl_response = curl_exec($ch);
            if ($curl_response === false) {
                $response = ['status' => 'error', 'message' => 'ESP8266 communication failed'];
                error_log("Delete: ESP8266 error: " . curl_error($ch));
            } else {
                $result = json_decode($curl_response, true);
                if (is_array($result) && isset($result['status']) && $result['status'] == 'success') {
                    try {
                        $employeesCollection->deleteOne(['fingerprint_id' => $fingerprint_id]);
                        $response = ['status' => 'success', 'message' => $result['message']];
                    } catch (Exception $e) {
                        $response = ['status' => 'error', 'message' => 'Database error'];
                        error_log("Delete: MongoDB error: " . $e->getMessage());
                    }
                } else {
                    $response = ['status' => 'error', 'message' => $result['message'] ?? 'Invalid ESP8266 response'];
                }
            }
            curl_close($ch);
            break;

        case 'delete_attendance':
            if (!isset($_POST['attendance_id'])) {
                $response = ['status' => 'error', 'message' => 'Missing attendance_id'];
                break;
            }
            try {
                $attendance_id = new \MongoDB\BSON\ObjectId($_POST['attendance_id']);
                $deleteResult = $attendanceCollection->deleteOne(['_id' => $attendance_id]);
                $response = [
                    'status' => $deleteResult->getDeletedCount() > 0 ? 'success' : 'error',
                    'message' => $deleteResult->getDeletedCount() > 0 ? 'Attendance record deleted' : 'Failed to delete attendance record'
                ];
            } catch (Exception $e) {
                $response = ['status' => 'error', 'message' => 'Database error'];
                error_log("Delete Attendance: MongoDB error: " . $e->getMessage());
            }
            break;

        case 'add_admin':
            if (!isset($_POST['username']) || !isset($_POST['password'])) {
                $response = ['status' => 'error', 'message' => 'Missing username or password'];
                break;
            }
            $username = trim($_POST['username']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            try {
                if ($usersCollection->findOne(['username' => $username])) {
                    $response = ['status' => 'error', 'message' => 'Username already exists'];
                    break;
                }
                $usersCollection->insertOne([
                    'username' => $username,
                    'password' => $password,
                    'created_at' => new \MongoDB\BSON\UTCDateTime()
                ]);
                $response = ['status' => 'success', 'message' => 'Admin added successfully'];
            } catch (Exception $e) {
                $response = ['status' => 'error', 'message' => 'Database error'];
                error_log("Add Admin: MongoDB error: " . $e->getMessage());
            }
            break;

        case 'update_admin_password':
            if (!isset($_POST['user_id']) || !isset($_POST['new_password'])) {
                $response = ['status' => 'error', 'message' => 'Missing user_id or new_password'];
                break;
            }
            try {
                $user_id = new \MongoDB\BSON\ObjectId($_POST['user_id']);
                $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                $updateResult = $usersCollection->updateOne(
                    ['_id' => $user_id],
                    ['$set' => ['password' => $new_password]]
                );
                $response = [
                    'status' => $updateResult->getModifiedCount() > 0 ? 'success' : 'error',
                    'message' => $updateResult->getModifiedCount() > 0 ? 'Password updated successfully' : 'Failed to update password'
                ];
            } catch (Exception $e) {
                $response = ['status' => 'error', 'message' => 'Database error'];
                error_log("Update Admin Password: MongoDB error: " . $e->getMessage());
            }
            break;

        case 'delete_admin':
            if (!isset($_POST['user_id'])) {
                $response = ['status' => 'error', 'message' => 'Missing user_id'];
                break;
            }
            try {
                $user_id = new \MongoDB\BSON\ObjectId($_POST['user_id']);
                if ((string) $user_id === ($_SESSION['user_id'] ?? '')) {
                    $response = ['status' => 'error', 'message' => 'Cannot delete your own account'];
                    break;
                }
                $deleteResult = $usersCollection->deleteOne(['_id' => $user_id]);
                $response = [
                    'status' => $deleteResult->getDeletedCount() > 0 ? 'success' : 'error',
                    'message' => $deleteResult->getDeletedCount() > 0 ? 'Admin deleted successfully' : 'Failed to delete admin'
                ];
            } catch (Exception $e) {
                $response = ['status' => 'error', 'message' => 'Database error'];
                error_log("Delete Admin: MongoDB error: " . $e->getMessage());
            }
            break;

        default:
            $response = ['status' => 'error', 'message' => 'Unknown action'];
            error_log("Unknown action: " . $action);
    }
}

ob_end_clean();
echo json_encode($response);
?>