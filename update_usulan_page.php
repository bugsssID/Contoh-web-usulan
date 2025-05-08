<?php
include 'config.php';
if (isset($_SESSION['nik']) && $_SESSION['nik'] == true) {
    //  echo "Welcome to the member's area, " . $_SESSION['AKSES'] . "!";
  } else {
      echo"<script> window.location.href = 'login.php' ; </script>";
      exit;
  }

$no_usulan = $_GET['no_usulan'];

$sql = "SELECT * FROM tabel_usulan WHERE no_usulan = :no_usulan";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':no_usulan', $no_usulan);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tgl_dibuat = $_POST['tgl_dibuat'];
    $tgl_approve = $_POST['tgl_approve'];
    $bagian = $_POST['bagian'];
    $usulan = $_POST['usulan'];
    $qty = $_POST['qty'];
    $frac = $_POST['frac'];
    $est_harga_satuan = $_POST['est_harga_satuan'];
    $total = $_POST['total'];
    $sertim_ke_adm = $_POST['sertim_ke_adm'];
    $sertim_ke_ga = $_POST['sertim_ke_ga'];
    $pic = $_POST['pic'];
    $ket = $_POST['ket'];
    $realisasi = $_POST['realisasi'];
    $sertim_ke_bagian = $_POST['sertim_ke_bagian'];
    $pic_bagian = $_POST['pic_bagian'];
    $status = $_POST['status'];

    $sql = "UPDATE tabel_usulan SET TGL_DIBUAT = :tgl_dibuat, TGL_APPROVE = :tgl_approve, BAGIAN = :bagian, USULAN = :usulan, QTY = :qty, FRAC = :frac, EST_HARGA_SATUAN = :est_harga_satuan, TOTAL = :total, SERTIM_KE_ADM = :sertim_ke_adm, SERTIM_KE_GA = :sertim_ke_ga, PIC = :pic, KET = :ket, REALISASI = :realisasi, SERTIM_KE_BAGIAN = :sertim_ke_bagian, PIC_BAGIAN = :pic_bagian, STATUS = :status WHERE no_usulan = :no_usulan";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':no_usulan', $no_usulan);
    $stmt->bindParam(':tgl_dibuat', $tgl_dibuat);
    $stmt->bindParam(':tgl_approve', $tgl_approve);
    $stmt->bindParam(':bagian', $bagian);
    $stmt->bindParam(':usulan', $usulan);
    $stmt->bindParam(':qty', $qty);
    $stmt->bindParam(':frac', $frac);
    $stmt->bindParam(':est_harga_satuan', $est_harga_satuan);
    $stmt->bindParam(':total', $total);
    $stmt->bindParam(':sertim_ke_adm', $sertim_ke_adm);
    $stmt->bindParam(':sertim_ke_ga', $sertim_ke_ga);
    $stmt->bindParam(':pic', $pic);
    $stmt->bindParam(':ket', $ket);
    $stmt->bindParam(':realisasi', $realisasi);
    $stmt->bindParam(':sertim_ke_bagian', $sertim_ke_bagian);
    $stmt->bindParam(':pic_bagian', $pic_bagian);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        header('Location: monitoring.php');
        exit;
    } else {
        $error_message = "Error: " . $sql . "<br>" . $stmt->errorInfo();
    }
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
                    <h1 class="m-0">Update Usulan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Update Usulan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update Usulan</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?no_usulan=' . $no_usulan; ?>" class="form-horizontal">
                                <div class="form-group row">
                                    <label for="tgl_dibuat" class="col-sm-2 col-form-label">Tanggal Dibuat:</label>
                                    <div class="col-sm-2">
                                        <input type="date" id="tgl_dibuat" name="tgl_dibuat" class="form-control" value="<?php echo $row['tgl_dibuat']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_approve" class="col-sm-2 col-form-label">Tanggal Approve:</label>
                                    <div class="col-sm-2">
                                        <input type="date" id="tgl_approve" name="tgl_approve" class="form-control" value="<?php echo $row['tgl_approve']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bagian" class="col-sm-2 col-form-label">Bagian:</label>
                                    <div class="col-sm-2">
                                        <select id="bagian" name="bagian" class="form-control" readonly>
                                            <option value="WAREHOUSE" <?php if ($row['bagian'] == 'WAREHOUSE') echo 'selected'; ?>>WAREHOUSE</option>
                                            <option value="ISSUING" <?php if ($row['bagian'] == 'ISSUING') echo 'selected'; ?>>ISSUING</option>
                                            <option value="DELIVERY" <?php if ($row['bagian'] == 'DELIVERY') echo 'selected'; ?>>DELIVERY</option>
                                            <option value="PERISHABLE" <?php if ($row['bagian'] == 'PERISHABLE') echo 'selected'; ?>>PERISHABLE</option>
                                            <option value="ADMIN" <?php if ($row['bagian'] == 'ADMIN') echo 'selected'; ?>>ADMIN</option>
                                            <option value="RETUR" <?php if ($row['bagian'] == 'RETUR') echo 'selected'; ?>>RETUR</option>
                                            <option value="RECEIVING" <?php if ($row['bagian'] == 'RECEIVING') echo 'selected'; ?>>RECEIVING</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="usulan" class="col-sm-2 col-form-label">Usulan:</label>
                                    <div class="col-sm-6">
                                        <textarea id="usulan" name="usulan" class="form-control" rows="4" readonly><?php echo $row['usulan']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="qty" class="col-sm-2 col-form-label">Quantity:</label>
                                    <div class="col-sm-3">
                                        <input type="number" id="qty" name="qty" class="form-control" value="<?php echo $row['qty']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="frac" class="col-sm-2 col-form-label">Fraction:</label>
                                    <div class="col-sm-3">
                                        <select id="frac" name="frac" class="form-control" readonly>
                                            <option value="PCS" <?php if ($row['frac'] == 'PCS') echo 'selected'; ?>>PCS</option>
                                            <option value="PASANG" <?php if ($row['frac'] == 'PASANG') echo 'selected'; ?>>PASANG</option>
                                            <option value="UNIT" <?php if ($row['frac'] == 'UNIT') echo 'selected'; ?>>UNIT</option>
                                            <option value="KARTON" <?php if ($row['frac'] == 'KARTON') echo 'selected'; ?>>KARTON</option>
                                            <option value="KG" <?php if ($row['frac'] == 'KG') echo 'selected'; ?>>KG</option>
                                            <option value="CM" <?php if ($row['frac'] == 'CM') echo 'selected'; ?>>CM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="est_harga_satuan" class="col-sm-2 col-form-label">Estimasi Harga Satuan:</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="est_harga_satuan" name="est_harga_satuan" class="form-control" value="<?php echo $row['est_harga_satuan']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="total" class="col-sm-2 col-form-label">Total:</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="total" name="total" class="form-control" value="<?php echo $row['total']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="sertim_ke_adm" class="col-sm-2 col-form-label">Sertim ADM:</label>
                                    <div class="col-sm-3">
                                        <input type="date" id="sertim_ke_adm" name="sertim_ke_adm" class="form-control" value="<?php echo $row['sertim_ke_adm']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="sertim_ke_ga" class="col-sm-2 col-form-label">Sertim GA:</label>
                                    <div class="col-sm-3">
                                        <input type="date" id="sertim_ke_ga" name="sertim_ke_ga" class="form-control" value="<?php echo $row['sertim_ke_ga']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pic" class="col-sm-2 col-form-label">PIC GA:</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="pic" name="pic" class="form-control" value="<?php echo $row['pic']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ket" class="col-sm-2 col-form-label">Keterangan:</label>
                                    <div class="col-sm-6">
                                        <textarea id="ket" name="ket" class="form-control" rows="4" required><?php echo $row['ket']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="realisasi" class="col-sm-2 col-form-label">Realisasi:</label>
                                    <div class="col-sm-3">
                                        <input type="date" id="realisasi" name="realisasi" class="form-control" value="<?php echo $row['realisasi']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="sertim_ke_bagian" class="col-sm-2 col-form-label">Sertim ke Bagian:</label>
                                    <div class="col-sm-3">
                                        <input type="date" id="sertim_ke_bagian" name="sertim_ke_bagian" class="form-control" value="<?php echo $row['sertim_ke_bagian']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pic_bagian" class="col-sm-2 col-form-label">PIC Bagian:</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="pic_bagian" name="pic_bagian" class="form-control" value="<?php echo $row['pic_bagian']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Status:</label>
                                    <div class="col-sm-3">
                                        <select id="status" name="status" class="form-control" required>
                                            <option value="PENDING" <?php if ($row['status'] == 'PENDING') echo 'selected'; ?>>PENDING</option>
                                            <option value="APPROVED" <?php if ($row['status'] == 'APPROVED') echo 'selected'; ?>>APPROVED</option>
                                            <option value="REJECTED" <?php if ($row['status'] == 'REJECTED') echo 'selected'; ?>>REJECTED</option>
                                            <option value="SELESAI" <?php if ($row['status'] == 'SELESAI') echo 'selected'; ?>>SELESAI</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
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
