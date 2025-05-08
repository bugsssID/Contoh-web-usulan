<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo 'Please fill in both fields.';
        exit;
    }

    $stmt = $pdo->prepare('SELECT * FROM user_dc WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($password, $user['pass'])) { // Ensure 'pass' matches the column name in your database
            $_SESSION['nik'] = $user['nik']; // Change 'user_id' to 'nik'
            $_SESSION['username'] = $user['username']; // Set the username in the session
            $_SESSION['role'] = $user['role'];
            $_SESSION['bagian'] = $user['bagian']; // Set the role in the session
            header('Location: index.php');
            exit;
        } else {
            echo '<script>alert("Invalid password."); window.location.href = "login.php";</script>';
        }
    } else {
        echo '<script>alert("Invalid username."); window.location.href = "login.php";</script>';
    }
}
?>
