<?php
session_start();
require_once 'vendor/autoload.php'; // Composer autoloader for MongoDB

use MongoDB\Client;

// Database connection - UPDATE THESE VALUES
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

// Set timezone (change to your timezone)
date_default_timezone_set('Africa/Nairobi');

// ESP8266 IP - Update with your ESP8266 device IP
$esp8266_ip = '192.168.137.239';

// Check if user is logged in
