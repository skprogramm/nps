<?php
/**
 * Database Configuration
 * Uses environment variables for database connection
 */

require_once __DIR__ . '/env-loader.php';

// Load environment variables
EnvLoader::load();

// Database configuration from environment
$host = EnvLoader::get('DB_HOST');
$user = EnvLoader::get('DB_USER');
$pass = EnvLoader::get('DB_PASS', '');
$dbname = EnvLoader::get('DB_NAME');
$port = EnvLoader::get('DB_PORT');

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    // Log error for debugging
    error_log("Database connection failed: " . $conn->connect_error);
    
    // Show user-friendly error in development, generic error in production
    if (EnvLoader::get('APP_DEBUG', false)) {
        die("Database connection failed: " . $conn->connect_error);
    } else {
        die("Database connection error. Please try again later.");
    }
}

// Set charset to UTF-8
$conn->set_charset("utf8");

// Set timezone
$conn->query("SET time_zone = '+00:00'");
?>
