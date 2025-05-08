<?php
include 'config.php';

if (isset($_GET['idpp'])) {
    $idpp = $_GET['idpp'];
    $query = "DELETE FROM tabel_PP WHERE idpp = :idpp";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['idpp' => $idpp]);

    $_SESSION['message'] = "Data deleted successfully";
    header('Location: monitoring_pp.php');
}
?>
