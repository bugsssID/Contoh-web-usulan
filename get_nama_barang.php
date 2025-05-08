<?php
include 'config.php';

if (isset($_POST['plu'])) {
    $plu = $_POST['plu'];
    $stmt = $pdo->prepare("SELECT deskripsi FROM budget WHERE plu = ?");
    $stmt->execute([$plu]);
    $result = $stmt->fetch();
    echo $result['deskripsi'];
}
?>