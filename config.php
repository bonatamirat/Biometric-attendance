<?php
session_start();
require_once 'vendor/autoload.php'; // Composer autoloader for MongoDB

use MongoDB\Client;

// Database connection
$host = 'mongodb://localhost:27017';
$database = 'biometric_attendance';

try {
    $client = new Client($host);
    $db = $client->$database;
} catch (Exception $e) {
    error_log("MongoDB Connection failed: " . $e->getMessage());
    die("MongoDB Connection failed. Please check if MongoDB is running.");
}

// Collections
$employeesCollection = $db->employees;
$attendanceCollection = $db->attendance;
$usersCollection = $db->users;

// Set timezone
date_default_timezone_set('Africa/Nairobi');

// ESP8266 IP
$esp8266_ip = '192.168.137.239'; // Update with your ESP8266 IP

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Redirect to login if not authenticated
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

// Authenticate user
function authenticateUser($usersCollection, $username, $password) {
    try {
        $user = $usersCollection->findOne(['username' => trim($username)]);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = (string) $user['_id'];
            $_SESSION['username'] = $user['username'];
            return true;
        }
    } catch (Exception $e) {
        error_log("Authenticate: MongoDB error: " . $e->getMessage());
    }
    return false;
}
?>