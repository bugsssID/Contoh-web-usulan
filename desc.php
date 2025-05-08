<?php
// Koneksi ke database menggunakan PDO
include 'config.php';
try {

    // Ambil PLU dari request POST
    if (isset($_POST['plu'])) {
        $plu = $_POST['plu'];

        // Query untuk mencari barang berdasarkan PLU
        $stmt = $pdo->prepare("SELECT deskripsi, harga_satuan, total FROM bugdet WHERE PLU = :plu");
        $stmt->execute(['plu' => $plu]);
        $barang = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kirim hasil sebagai JSON
        if ($barang) {
            echo json_encode([
                'success' => true,
                'deskripsi' => $barang['deskripsi'],
                'harga_satuan' => $barang['harga_satuan'],
                'total' => $barang['total']
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Barang tidak ditemukan'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'PLU tidak diberikan'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>