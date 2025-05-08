<?php
include 'config.php';

if (isset($_GET['idpp'])) {
    $idpp = $_GET['idpp'];
    $query = "SELECT * FROM tabel_pp WHERE idpp = :idpp";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['idpp' => $idpp]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idpp = $_POST['idpp'];
    $tanggal = $_POST['tanggal'];
    $nomor_surat = $_POST['nomor_surat'];
    $plu = $_POST['plu'];
    $deskripsi = $_POST['deskripsi'];
    $qty = $_POST['qty'];
    $budget_2024 = $_POST['budget_2024'];
    $sisa_budget = $_POST['sisa_budget'];
    $harga_satuan = $_POST['harga_satuan'];
    $total_harga = $_POST['total_harga'];
    $status_pp = $_POST['status_pp'];
    $pic = $_POST['pic'];
    $status_berkas = $_POST['status_berkas'];
    $no_pp = $_POST['no_pp'];
    $dasar_pp = $_POST['dasar_pp'];
    $no_sp = $_POST['no_sp'];
    $status_btb = $_POST['status_btb'];

    $query = "update tabel_pp set tanggal = :tanggal, nomor_surat = :nomor_surat, plu = :plu, deskripsi = :deskripsi, qty = :qty, budget_2024 = :budget_2024, sisa_budget = :sisa_budget, harga_satuan = :harga_satuan, total_harga = :total_harga, status_pp = :status_pp, pic = :pic, status_berkas = :status_berkas, no_pp = :no_pp, dasar_pp = :dasar_pp, no_sp = :no_sp, status_btb = :status_btb where idpp = :idpp";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'idpp' => $idpp,
        'tanggal' => $tanggal,
        'nomor_surat' => $nomor_surat,
        'plu' => $plu,
        'deskripsi' => $deskripsi,
        'qty' => $qty,
        'budget_2024' => $budget_2024,
        'sisa_budget' => $sisa_budget,
        'harga_satuan' => $harga_satuan,
        'total_harga' => $total_harga,
        'status_pp' => $status_pp,
        'pic' => $pic,
        'status_berkas' => $status_berkas,
        'no_pp' => $no_pp,
        'dasar_pp' => $dasar_pp,
        'no_sp' => $no_sp,
        'status_btb' => $status_btb


    ]);

    $_SESSION['message'] = "Data updated successfully";
    header('Location: monitoring_pp.php');
    exit();
}
?>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<?php include('sidebar.php'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update PP Data</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Update PP Data</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">PP Details</h3>
                        </div>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?idpp=' . $idpp; ?>" class="form-horizontal">
                            <div class="card-body">
                                <input type="hidden" name="idpp" value="<?php echo htmlspecialchars($data['idpp'] ?? ''); ?>">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($data['tanggal'] ?? ''); ?>" Readonly>
                                </div>                               
                                <div class="col-md-3">
                                    <label for="Nomor_Surat">Nomor Surat</label>
                                    <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="<?php echo htmlspecialchars($data['nomor_surat'] ?? ''); ?>" Readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="PLU">PLU</label>
                                    <input type="text" class="form-control" id="plu" name="plu" value="<?php echo htmlspecialchars($data['plu'] ?? ''); ?>">
                                </div>
                                </div>
                                </div>
                                <div class="form-group">
                                <div class="row">
                                <div class="col-md-6">
                                    <label for="Deskripsi">Deskripsi</label>
                                    <input class="form-control" id="deskripsi" name="deskripsi" value="<?php echo htmlspecialchars($data['deskripsi'] ?? ''); ?>"Readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="Qty">Qty</label>
                                    <input type="number" class="form-control" id="qty" name="qty" value="<?php echo htmlspecialchars($data['qty'] ?? ''); ?>"Readonly>
                                </div>
                                </div>
                                </div>
                                <div class="form-group">
                                <div class="row">
                                <div class="col-md-3">
                                    <label for="Budget_2024">Budget 2024</label>
                                    <input type="number" step="0.01" class="form-control" id="budget_2024" name="budget_2024" value="<?php echo htmlspecialchars($data['budget_2024'] ?? ''); ?>"Readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="Sisa_Budget">Sisa Budget</label>
                                    <input type="number" step="0.01" class="form-control" id="sisa_budget" name="sisa_budget" value="<?php echo htmlspecialchars($data['sisa_budget'] ?? ''); ?>"Readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="Harga_Satuan">Harga Satuan</label>
                                    <input type="number" step="0.01" class="form-control" id="harga_satuan" name="harga_satuan" value="<?php echo htmlspecialchars($data['harga_satuan'] ?? ''); ?>"Readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="Total_Harga">Total Harga</label>
                                    <input type="number" step="0.01" class="form-control" id="total_harga" name="total_harga" value="<?php echo htmlspecialchars($data['total_harga'] ?? ''); ?>"Readonly>
                                </div>
                                </div>
                                </div>
                                <div class="form-group">
                                <div class="row">
                                <div class="col-md-3">
                                    <label for="Status_PP">Status PP</label>
                                    <input type="text" class="form-control" id="status_pp" name="status_pp" value="<?php echo htmlspecialchars($data['status_pp'] ?? ''); ?>"Readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="PIC">PIC</label>
                                    <input type="text" class="form-control" id="pic" name="pic" value="<?php echo htmlspecialchars($data['pic'] ?? ''); ?>"Readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="Status_Berkas">Status Berkas</label>
                                    <select class="form-control" id="status_berkas" name="status_berkas">
                                        <option value="">Pilih Status</option>
                                        <option value="BARU" <?php echo (isset($data['status_berkas']) && $data['status_berkas'] == 'BARU') ? 'selected' : ''; ?>>BARU</option>
                                        <option value="ESIGN" <?php echo (isset($data['status_berkas']) && $data['status_berkas'] == 'ESIGN') ? 'selected' : ''; ?>>ESIGN</option>
                                        <option value="REJECT" <?php echo (isset($data['status_berkas']) && $data['status_berkas'] == 'REJECT') ? 'selected' : ''; ?>>REJECT</option>
                                        <option value="SUDAH BTB" <?php echo (isset($data['status_berkas']) && $data['status_berkas'] == 'SUDAH BTB') ? 'selected' : ''; ?>>SUDAH BTB</option>
                                        <option value="TERBENTUK PP" <?php echo (isset($data['status_berkas']) && $data['status_berkas'] == 'TERBENTUK PP') ? 'selected' : ''; ?>>TERBENTUK PP</option>
                                        <option value="TERBENTUK SP" <?php echo (isset($data['status_berkas']) && $data['status_berkas'] == 'TERBENTUK SP') ? 'selected' : ''; ?>>TERBENTUK SP</option>
                                        <option value="UPLOAD FTP" <?php echo (isset($data['status_berkas']) && $data['status_berkas'] == 'UPLOAD FTP') ? 'selected' : ''; ?>>UPLOAD FTP</option>
                                    </select>
                                </div>
                                </div>
                                </div>
                                <div class="form-group">
                                <div class="row">
                                <div class="col-md-3">
                                    <label for="No_pp">No PP</label>
                                    <input type="text" class="form-control" id="no_pp" name="no_pp" value="<?php echo htmlspecialchars($data['no_pp'] ?? ''); ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="Dasar_PP">Dasar PP</label>
                                    <input class="form-control" id="dasar_pp" name="dasar_pp" value="<?php echo htmlspecialchars($data['dasar_pp'] ?? ''); ?>"Readonly>
                                </div>
                                </div>
                                </div>
                                <div class="form-group">
                                <div class="row">
                                <div class="col-md-3">
                                    <label for="No_sp">No SP</label>
                                    <input type="text" class="form-control" id="no_sp" name="no_sp" value="<?php echo htmlspecialchars($data['no_sp'] ?? ''); ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="Status_BTB">Status BTB</label>
                                    <input type="text" class="form-control" id="status_btb" name="status_btb" value="<?php echo htmlspecialchars($data['status_btb'] ?? ''); ?>">
                                </div>
                                </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                                <a href="monitoring_pp.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include('footer.php'); ?>
