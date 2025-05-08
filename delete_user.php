<?php
include 'config.php';

if (isset($_GET['nik'])) {
    $nik = $_GET['nik'];
    $query = "DELETE FROM user_dc WHERE nik = :nik";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['nik' => $nik]);

    $_SESSION['message'] = "User deleted successfully";
    header('Location: user_list.php');
}
?>
