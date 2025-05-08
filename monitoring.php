<?php include('config.php');
if (isset($_SESSION['nik']) && $_SESSION['nik'] == true) {
    //  echo "Welcome to the member's area, " . $_SESSION['AKSES'] . "!";
  } else {
      echo"<script> window.location.href = 'login.php' ; </script>";
      exit;
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
                    <h1 class="m-0">Monitoring Usulan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Monitoring Usulan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Usulan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>TGL_DIBUAT</th>
                                        <th>TGL_APPROVE</th>
                                        <th>BAGIAN</th>
                                        <th>USULAN</th>
                                        <th>QTY</th>
                                        <th>FRAC</th>
                                        <th>EST_HARGA_SATUAN</th>
                                        <th>TOTAL</th>
                                        <th>SERTIM_KE_ADM</th>
                                        <th>SERTIM_KE_GA</th>
                                        <th>PIC</th>
                                        <th>KET</th>
                                        <th>REALISASI</th>
                                        <th>SERTIM_KE_BAGIAN</th>
                                        <th>PIC_BAGIAN</th>
                                        <th>STATUS</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM tabel_usulan";
                                    $stmt = $pdo->query($query);
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['tgl_dibuat'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['tgl_approve'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['bagian'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['usulan'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['qty'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['frac'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['est_harga_satuan'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['total'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['sertim_ke_adm'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['sertim_ke_ga'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['pic'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['ket'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['realisasi'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['sertim_ke_bagian'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['pic_bagian'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['status'] ?? '') . "</td>";
                                        if ($_SESSION['role'] == 'admin') {
                                            echo "<td>
                                                    <a href='update_usulan_page.php?no_usulan=" . urlencode($row['no_usulan']) . "' class='btn btn-primary btn-sm'>Edit</a>
                                                     <a href='print_usulan.php?no_usulan=" . urlencode($row['no_usulan']) . "' rel='noopener' target='_blank' class='btn btn-default btn-sm'>Cetak</a>
                                                    <form method='post' action='delete_usulan.php' style='display:inline-block;'>
                                                        <input type='hidden' name='id' value='" . htmlspecialchars($row['no_usulan']) . "'>
                                                        <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus?\")'>Delete</button>
                                                    </form>
                                                  </td>";
                                        } else {
                                            echo "<td></td>"; // Kosongkan kolom aksi jika bukan admin
                                        }
                                    
                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>


