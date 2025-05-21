<?php
$servername = getenv('MYSQL_HOST') ?: 'db';
$username = getenv('MYSQL_USER') ?: 'forum_user';
$password = getenv('MYSQL_PASSWORD') ?: 'forum_password';
$dbname = getenv('MYSQL_DB') ?: 'forum_db';

// Add a retry mechanism for database connection
$retries = 5;
$conn = null;

// Suppress warnings during connection attempts
error_reporting(E_ERROR); // Temporarily reduce error reporting
ini_set('display_errors', 0); // Turn off displaying errors

while ($retries > 0) {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        $retries--;
        if ($retries <= 0) {
            // Restore error reporting before dying
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            die("Connection failed: " . $conn->connect_error);
        }
        // Wait for 3 seconds before retrying
        sleep(3);
    } else {
        // Connection successful
        break;
    }
}

// Restore normal error reporting after connection is established
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>