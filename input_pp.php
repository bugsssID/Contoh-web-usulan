<?php
// Include the database connection from config.php
include 'config.php';

// Ensure $pdo is defined
if (!isset($pdo)) {
    die("Database connection not established.");
}

$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idpp = time(); // Generate a unique integer ID for idpp
    $tanggal = $_POST['tanggal'];
    $Nomor_Surat = $_POST['Nomor_Surat'];
    $PLU = $_POST['PLU'];
    $Deskripsi = $_POST['Deskripsi'];
    $Qty = $_POST['Qty'];
    $Budget_2024 = $_POST['Budget_2024'];
    $Sisa_Budget = $_POST['Sisa_Budget'];
    $Harga_Satuan = $_POST['Harga_Satuan'];
    $Total_Harga = $_POST['Total_Harga'];
    $Status_PP = $_POST['Status_PP'];
    $PIC = $_POST['PIC'];
    $Status_Berkas='BARU';
    $Dasar_PP = $_POST['Dasar_PP'];

    if ($tanggal && $Nomor_Surat && $PLU && $Deskripsi && $Qty && $Budget_2024 && $Sisa_Budget && $Harga_Satuan && $Total_Harga && $Status_PP && $PIC  && $Dasar_PP) {
        $sql = "INSERT INTO tabel_pp (idpp, tanggal, Nomor_Surat, PLU, Deskripsi, Qty, Budget_2024, Sisa_Budget, Harga_Satuan, Total_Harga, Status_PP, PIC,status_berkas, Dasar_PP) 
            VALUES (:idpp, :tanggal, :Nomor_Surat, :PLU, :Deskripsi, :Qty, :Budget_2024, :Sisa_Budget, :Harga_Satuan, :Total_Harga, :Status_PP, :PIC ,:Status_Berkas,:Dasar_PP)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idpp', $idpp);
        $stmt->bindParam(':tanggal', $tanggal);
        $stmt->bindParam(':Nomor_Surat', $Nomor_Surat);
        $stmt->bindParam(':PLU', $PLU);
        $stmt->bindParam(':Deskripsi', $Deskripsi);
        $stmt->bindParam(':Qty', $Qty);
        $stmt->bindParam(':Budget_2024', $Budget_2024);
        $stmt->bindParam(':Sisa_Budget', $Sisa_Budget);
        $stmt->bindParam(':Harga_Satuan', $Harga_Satuan);
        $stmt->bindParam(':Total_Harga', $Total_Harga);
        $stmt->bindParam(':Status_PP', $Status_PP);
        $stmt->bindParam(':PIC', $PIC);
        $stmt->bindParam(':Status_Berkas', $Status_Berkas);
        $stmt->bindParam(':Dasar_PP', $Dasar_PP);

        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data telah berhasil disimpan.',
                    showConfirmButton: false,
                    timer: 1500

                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan: " . $stmt->errorInfo()[2] . "',
                });
            </script>";
        }
        }
        }
        // Connection successful
        $stmt = $pdo->prepare("SELECT plu,deskripsi FROM bugdet");
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            $PLU = $row["plu"];
}

try {
    // Fungsi untuk mengonversi bulan ke angka romawi
    function getRomanMonth($month) {
        $romanMonths = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
            5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
            9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];
        return $romanMonths[$month];
    }
    // Ambil data terakhir dari tabel
    $stmt = $pdo->query("SELECT nomor_surat FROM tabel_pp ORDER BY idpp DESC LIMIT 1");
    $lastRecord = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($lastRecord) {
        // Pisahkan nomor urut dari nomor surat terakhir
        $lastNomorSurat = $lastRecord['nomor_surat'];
        $lastNomorUrut = intval(substr($lastNomorSurat, 0, 3)); // Ambil 3 digit pertama
        $newNomorUrut = $lastNomorUrut + 1;
    } else {
        // Jika belum ada data, mulai dari 1
        $newNomorUrut = 1;
    }
    // Format nomor urut dengan leading zero
    $formattedNomorUrut = str_pad($newNomorUrut, 3, '0', STR_PAD_LEFT);
    // Dapatkan bulan dan tahun saat ini
    $currentMonth = date('n'); // Bulan tanpa leading zero (1-12)
    $currentYear = date('Y');
    // Konversi bulan ke angka romawi
    $romanMonth = getRomanMonth($currentMonth);
    // Buat nomor surat baru
    $newNomorSurat = "{$formattedNomorUrut}/PPDC/DCPWK/{$romanMonth}/{$currentYear}";
    //echo "Nomor Surat Baru: {$newNomorSurat}";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<?php include('sidebar.php'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">INPUT PERMINTAAN PEMBELIAN KE HO</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Input PP</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <?php if ($success_message): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            <?php if ($error_message): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">REKAP PP KE HO</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="" class="form-input-pp">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="tanggal" class="form-label">Tanggal:</label>
                                            <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="Nomor_Surat" class="form-label">Nomor Surat:</label>
                                            <input type="text" id="Nomor_Surat" name="Nomor_Surat" value="<?php echo htmlspecialchars($newNomorSurat ?? ''); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="PLU" class="form-label">PLU:</label>
                                    <select id="PLU" name="PLU" class="form-control col-md-3 select2" required>
                                        <option selected="selected">Silahkan Pilih Kode PLU</option>
                                        <?php foreach ($result as $row) { ?>
                                            <option value="<?php echo $row["plu"]; ?>"><?php echo $row["plu"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="Deskripsi" class="form-label">Deskripsi:</label>
                                            <input id="Deskripsi" name="Deskripsi" class="form-control" required readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="Qty" class="form-label">Qty:</label>
                                            <input type="number"  id="Qty" name="Qty" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <label for="Budget_2024" class="form-label">Total Budget:</label>
                                            <input type="text"  id="Budget_2024" name="Budget_2024" class="form-control" required readonly>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="Sisa_Budget" class="form-label">Sisa Budget:</label>
                                            <input type="number" id="Sisa_Budget" name="Sisa_Budget" class="form-control" required readonly>
                                        </div>        
                                        <div class="col-md-2">
                                            <label for="Harga_Satuan" class="form-label">Harga Satuan:</label>
                                            <input type="text"  id="Harga_Satuan" name="Harga_Satuan" class="form-control" required readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="Total_Harga" class="form-label">Total Harga:</label>
                                            <input type="number"  id="Total_Harga" name="Total_Harga" class="form-control" required readonly>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="Status_PP" class="form-label">Status PP:</label>
                                            <select id="Status_PP" name="Status_PP" class="form-control col-md-5" required>
                                            <option value="STANDAR">STANDAR</option>
                                            <option value="URGENT">URGENT</option>
                                            <option value="KEBUTUHAN">KEBUTUHAN</option>
                                            <option value="LAIN-LAIN">LAIN-LAIN</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="PIC" class="form-label">PIC:</label>
                                    <input type="text" id="PIC" name="PIC" value="<?php echo $_SESSION['bagian'];  ?>" class="form-control col-md-3" required readonly>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="Dasar_PP" class="form-label">Dasar PP:</label>
                                            <input id="Dasar_PP" name="Dasar_PP" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>
<script>
    $(document).ready(function() {
        $('#PLU').change(function() {
            var plu = $(this).val();
            $.ajax({
                url: 'desc.php',
                type: 'POST',
                data: { plu: plu },
                dataType: 'json', // Pastikan respons diterima dalam format JSON
                success: function(response) {
                    console.log("Response dari server:", response); // Debugging

                    if (response.success) {
                        $('#Deskripsi').val(response.deskripsi); // Set nilai input deskripsi
                        $('#Harga_Satuan').val(response.harga_satuan); // Set nilai Harga Satuan
                        $('#Budget_2024').val(response.total); // Set nilai Total
                    } else {
                        console.log("Pesan error:", response.message);
                        $('#Deskripsi').val('Deskripsi tidak ditemukan');
                        $('#Harga_Satuan').val('Data tidak ditemukan');
                        $('#Budget_2024').val('Data tidak ditemukan');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("AJAX Error:", textStatus, errorThrown);
                    $('#Deskripsi').val('Gagal mengambil data');
                    $('#Harga_Satuan').val('Gagal mengambil data');
                    $('#Budget_2024').val('Gagal mengambil data');
                }
            });
        });
    });
</script>
<script>
        $(document).ready(function () {
            // Event listener untuk input Qty
            $('#Qty').on('input', function () {
                // Ambil nilai Total dan Qty
                const total = parseFloat($('#Budget_2024').val()) || 0; // Default ke 0 jika kosong
                const qty = parseFloat($('#Qty').val()) || 0; // Default ke 0 jika kosong
                const hargaSatuan = parseFloat($('#Harga_Satuan').val()) || 0; // Default ke 0 jika kosong 

                // Hitung Sisa Budget
                const sisaBudget = total - qty;
                const totalHarga = hargaSatuan * qty;

                // Tampilkan hasil di input Sisa Budget (dibulatkan ke bilangan bulat)
                $('#Sisa_Budget').val(Math.round(sisaBudget)); // Bulatkan ke bilangan bulat
                $('#Total_Harga').val(totalHarga); // Bulatkan ke bilangan bulat
            });
        });
    </script>
