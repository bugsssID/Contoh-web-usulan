<?php
$host = "192.168.63.117"; // Ensure this IP address is correct and accessible
$port = "3306";
$dbname = "cctv_dc";
$user = "root";
$password = "262627";

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    if ($pdo) {
        // Connection successful
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Check if session is not already started
if (session_status() == PHP_SESSION_NONE) {
    // Secure cookie settings
    ini_set('session.cookie_secure', '1');
    ini_set('session.cookie_httponly', '1');
    ini_set('session.cookie_samesite', 'Strict');

    session_start();
}

?>

