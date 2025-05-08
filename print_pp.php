<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Pembelian </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }
        .underline {
            text-decoration: underline;
        }
        .mt-custom {
            margin-top: 40px; /* Atur jarak sesuai kebutuhan */
        }
        .spacer {
            margin-left: 40px; /* Atur jarak antara IDO dan EFO */
        }
        .row {
            display: flex;
            margin-bottom: 5px;
        }
        .label {
            font-weight: bold;
            width: 150px; /* Sesuaikan lebar kolom label */
        }
        .value {
            flex-grow: 1;
        }
        textarea {
            width: 100%; /* Lebar tetap 1000 piksel */
            padding: 8px;
        }
        .logo {
            height: 50px; /* Tinggi tetap */
            width: auto; /* Lebar otomatis untuk menjaga aspek rasio */
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f7dc6f;
        }
    </style>
    <?php
        include 'config.php';

        // Validasi nomor surat
        if (isset($_GET['nomor_surat'])) {
            $nomor_surat = $_GET['nomor_surat'];
            $query = "SELECT * FROM tabel_pp WHERE nomor_surat = :nomor_surat";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['nomor_surat' => $nomor_surat]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$data) {
                echo "<script>alert('Data tidak ditemukan!'); window.location.href = 'index.php';</script>";
                exit;
            }

            // Query untuk mengambil barang terkait
            $barangQuery = "SELECT * FROM tabel_pp WHERE nomor_surat = :nomor_surat";
            $barangStmt = $pdo->prepare($barangQuery);
            $barangStmt->execute(['nomor_surat' => $nomor_surat]);
            $barangData = $barangStmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "<script>alert('Nomor surat tidak valid!'); window.location.href = 'index.php';</script>";
            exit;
        }

        if (isset($_SESSION['nik']) && $_SESSION['nik']) {
            $bagian = $_SESSION['bagian'];
            try {
                $userQuery = "SELECT * FROM tabel_app_pp WHERE bagian = :bagian";
                $userStmt = $pdo->prepare($userQuery);
                $userStmt->execute([':bagian' => $bagian]);
                $userData = $userStmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "<script>window.location.href = 'login.php';</script>";
            exit;
        }
    ?>
</head>
<body class="p-8">
    <div class="max-w-4xl mx-auto border p-8">
        <div class="flex justify-center mb-4">
            <img alt="Indomaret Logo" src="logo_idm.jpg" class="logo">
        </div>
        <div class="text-center mb-4">
            <h1 class="font-bold">PT. INDOMARCO PRISMATAMA</h1>
            <p>DISTRIBUTION CENTER CABANG PURWAKARTA</p>
            <p>KAWASAN INDUSTRI KOTA BUKIT INDAH SEKTOR N BLOK N1 NO. 5</p>
            <p>PURWAKARTA</p>
            <p>Telpon 0264-8281903 atau 0264-8281906</p>
        </div>
        <hr class="border-t-4 border-black mb-4">
        <div class="text-center mb-4">
            <h2 class="font-bold">PERMOHONAN PEMBELIAN</h2>
            <p>NO : <?php echo htmlspecialchars($data['nomor_surat'] ?? ''); ?></p>
        </div>
        <div class="mb-4">
            <div class="container mt-5">
                <div class="row">
                    <div class="label">Kepada Yth</div>
                    <div class="value">: Bapak Hairul (Logistik Manager)</div>
                </div>
                <div class="row">
                    <div class="label">Dari</div>
                    <div class="value">: Distribution Center Purwakarta (G080)</div>
                </div>
                <div class="row">
                    <div class="label">Cc</div>
                    <div class="value">: Bapak Sigit (Logistik Area Manager)</div>
                </div>
                <div class="row">
                    <div class="label">Perihal</div>
                    <div class="value">: Permohonan Pembelian</div>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <p>Dengan hormat,</p>
            <textarea rows="3">Sehubungan dengan Kerusakan <?php echo htmlspecialchars($data['deskripsi'] ?? ''); ?> di DC Purwakarta, maka kami mengajukan permohonan pembelian dengan rincian sebagai berikut :</textarea>
        </div>
        <table class="w-full border-collapse border mb-2">
            <thead>
                <tr class="bg-yellow-300">
                    <th class="border px-2 py-1">NO</th>
                    <th class="border px-2 py-1">PLU</th>
                    <th class="border px-2 py-1">NAMA BARANG</th>
                    <th class="border px-2 py-1">TOTAL PP</th>
                    <th class="border px-2 py-1">KETERANGAN</th>
                </tr>
            </thead>
            <tbody style="font-size: 14px;">
                <?php foreach ($barangData as $index => $row): ?>
                    <tr>
                        <td class="border px-2 py-1 text-center"><?php echo $index + 1; ?></td>
                        <td class="border px-2 py-1 text-center">
                            <input type="text" value="<?php echo htmlspecialchars($row['plu'] ?? ''); ?>" style="width: 100px; text-align: center;">
                        </td>
                        <td class="border px-2 py-1 text-center"><?php echo htmlspecialchars($row['deskripsi'] ?? ''); ?></td>
                        <td class="border px-2 py-1 text-center"><?php echo htmlspecialchars($row['qty'] ?? ''); ?></td>
                        <td class="border px-2 py-1 text-center"><?php echo htmlspecialchars($row['dasar_pp'] ?? ''); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="mb-2">
            <p class="mt-12"><span class="spacer"></span> Besar harapan kami untuk dapat segera dipenuhi permohonan pembelian untuk memperlancar kinerja operasional di DC Purwakarta.</p>
            <p><span class="spacer"></span>Demikian permohonan pembelian ini kami ajukan, atas perhatian dan kerjasamanya saya ucapkan terima kasih.</p>
        </div>
        <div class="text-right mb-4">
            <p>
                Purwakarta, 
                <?php 
                    $tanggal = $data['tanggal'] ?? '';
                    if (!empty($tanggal)) {
                        echo htmlspecialchars(date('d F Y', strtotime($tanggal)));
                    } else {
                        echo 'Tanggal belum tersedia';
                    }
                ?>
            </p>
        </div>
        <div class="flex justify-between mb-4">
            <div class="text-center">
                <p>Disetujui,</p>
                <p class="mt-custom underline"><?php echo htmlspecialchars($userData['rlm'] ?? ''); ?></p>
            </div>
            <div class="text-center">
                <p>Mengetahui,</p>
                <p class="mt-custom underline"><?php echo htmlspecialchars($userData['log_dev'] ?? ''); ?> <span class="spacer"></span> <?php echo htmlspecialchars($userData['lm'] ?? ''); ?></p>
            </div>
            <div class="text-center">
                <p>Dibuat,</p>
                <p class="mt-custom underline"><?php echo htmlspecialchars($userData['dcm'] ?? ''); ?> <span class="spacer"></span><?php echo htmlspecialchars($userData['ddcm'] ?? ''); ?></p>
            </div>
        </div>
    </div>
</body>
</html>