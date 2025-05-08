<?php
// Koneksi ke database
$host = "192.168.63.117"; // Ensure this IP address is correct and accessible
$port = "5432";
$dbname = "postgres";
$user = "postgres";
$password = "262627";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    if ($pdo) {
        echo "Koneksi database berhasil";
        // Ambil data deskripsi dari database
        $plu = $_POST['plu'];
        $sql = "SELECT deskripsi FROM bugdet WHERE plu = :plu";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':plu', $plu);
        $stmt->execute();
        $result = $stmt->fetch();
        echo "Query database berhasil";
        if ($result) {
            echo "Data deskripsi ada";
            echo $result['deskripsi'];
        } else {
            echo "Data deskripsi tidak ada";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>