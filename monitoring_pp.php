<?php
include 'config.php';
if (isset($_SESSION['nik']) && $_SESSION['nik'] == true) {
    //  echo "Welcome to the member's area, " . $_SESSION['AKSES'] . "!";
  } else {
      echo"<script> window.location.href = 'login.php' ; </script>";
      exit;
  }
include 'header.php';
include 'navbar.php';
include 'sidebar.php';

$success_message = "";
$error_message = "";

// Fetch data from the database
try {
    $sql = "SELECT idpp, tanggal, nomor_surat, plu, deskripsi, qty, budget_2024, sisa_budget, harga_satuan, total_harga, status_pp, pic, status_berkas, no_pp, dasar_pp,no_sp,status_btb FROM tabel_pp order by nomor_surat asc";
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Error fetching data: " . $e->getMessage();
    $results = [];
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Monitoring Permintaan Barang ke HO</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Monitoring PP</li>
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
                            <h3 class="card-title">Monitoring Permintaan Barang ke HO</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nomor Surat</th>
                                        <th>PLU</th>
                                        <th>Deskripsi</th>
                                        <th>Qty</th>
                                        <th>Total Harga</th>
                                        <th>Status PP</th>
                                        <th>PIC</th>
                                        <th>Status Berkas</th>
                                        <th>Action</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $totalHargaKeseluruhan = 0;
                                        foreach ($results as $row): 
                                            $totalHargaKeseluruhan += (float)($row['total_harga'] ?? 0);
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['tanggal'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($row['nomor_surat'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($row['plu'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($row['deskripsi'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($row['qty'] ?? ''); ?></td>
                                            <td><?php echo 'Rp ' . number_format((float)($row['total_harga'] ?? 0), 0, ',', '.'); ?></td>
                                            <td><?php echo htmlspecialchars($row['status_pp'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($row['pic'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($row['status_berkas'] ?? ''); ?></td>
                                            <td>
                                            <?php if ($_SESSION['role'] == 'admin') { ?>
                                                <!-- Tombol untuk Admin -->
                                                <a href="update_monitoring_pp.php?idpp=<?php echo $row['idpp']; ?>" class="btn btn-primary">Update</a>
                                                <a href="delete_monitoring_pp.php?idpp=<?php echo $row['idpp']; ?>" class="btn btn-danger">Delete</a>
                                                <a href="print_pp.php?nomor_surat=<?php echo $row['nomor_surat']; ?>" rel="noopener" target="_blank" class="btn btn-default">
                                                    <i class="fas fa-print"></i> Print
                                                </a>
                                            <?php } elseif ($_SESSION['role'] == 'user') { ?>
                                                <!-- Tombol untuk User -->
                                                <a href="print_pp.php?nomor_surat=<?php echo $row['nomor_surat']; ?>" rel="noopener" target="_blank" class="btn btn-default">
                                                    <i class="fas fa-print"></i> Print
                                                </a>
                                            <?php } else { ?>
                                                <!-- Jika role tidak dikenali -->
                                                <p>Anda tidak memiliki akses ke fitur ini.</p>
                                            <?php } ?>
                                            </td>
                                           </tr>
                                           </tr>
                                            <?php endforeach; ?>
                                    </tr>
                                </tbody>
                                
                            </table>
                            <h5 class="breadcrumb-item">Total Harga : Rp <?php echo number_format($totalHargaKeseluruhan, 0, ',', '.'); ?></h5>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('footer.php'); ?>
