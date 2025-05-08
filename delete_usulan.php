<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_usulan = $_POST['id'];

    $sql = "DELETE FROM tabel_usulan WHERE no_usulan = :no_usulan";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':no_usulan', $no_usulan);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Record deleted successfully.";
        header('Location: monitoring.php');
        exit;
    } else {
        $_SESSION['error'] = "Error deleting record: " . $stmt->errorInfo();
        header('Location: monitoring.php');
        exit;
    }
}
?>
