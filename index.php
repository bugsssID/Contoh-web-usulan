<?php
include('config.php');
if (isset($_SESSION['nik']) && $_SESSION['nik'] == true) {
  //  echo "Welcome to the member's area, " . $_SESSION['AKSES'] . "!";
} else {
    echo"<script> window.location.href = 'login.php' ; </script>";
}

include('header.php');
include('navbar.php');
include('sidebar.php');

// Get total number of usulan
$query = "SELECT COUNT(*) AS total_usulan FROM tabel_usulan";
$stmt = $pdo->query($query);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_usulan = $row['total_usulan'];

// Get total number of pending usulan
$query_pending = "SELECT COUNT(*) AS total_pending FROM tabel_usulan WHERE status = 'PENDING'";
$stmt_pending = $pdo->query($query_pending);
$row_pending = $stmt_pending->fetch(PDO::FETCH_ASSOC);
$total_pending = $row_pending['total_pending'];

// Get total number of approved usulan
$query_approved = "SELECT COUNT(*) AS total_approved FROM tabel_usulan WHERE status = 'APPROVED'";
$stmt_approved = $pdo->query($query_approved);
$row_approved = $stmt_approved->fetch(PDO::FETCH_ASSOC);
$total_approved = $row_approved['total_approved'];

// Get total number of rejected usulan
$query_rejected = "SELECT COUNT(*) AS total_rejected FROM tabel_usulan WHERE status = 'REJECTED'";
$stmt_rejected = $pdo->query($query_rejected);
$row_rejected = $stmt_rejected->fetch(PDO::FETCH_ASSOC);
$total_rejected = $row_rejected['total_rejected'];

// Get total number of selesai usulan
$query_selesai = "SELECT COUNT(*) AS total_selesai FROM tabel_usulan WHERE status = 'SELESAI'";
$stmt_selesai = $pdo->query($query_selesai);
$row_selesai = $stmt_selesai->fetch(PDO::FETCH_ASSOC);
$total_selesai = $row_selesai['total_selesai'];

// Fetch counts for different PP statuses
try {
    $sql_total_pp = "SELECT COUNT(*) AS total FROM tabel_pp";
    $stmt_total_pp = $pdo->query($sql_total_pp);
    $total_pp = $stmt_total_pp->fetch(PDO::FETCH_ASSOC)['total'];

    $sql_esign = "SELECT COUNT(*) AS total FROM tabel_pp WHERE Status_Berkas = 'ESIGN'";
    $stmt_esign = $pdo->query($sql_esign);
    $total_esign = $stmt_esign->fetch(PDO::FETCH_ASSOC)['total'];

    $sql_reject = "SELECT COUNT(*) AS total FROM tabel_pp WHERE Status_Berkas = 'REJECT'";
    $stmt_reject = $pdo->query($sql_reject);
    $total_reject = $stmt_reject->fetch(PDO::FETCH_ASSOC)['total'];

    $sql_sudah_btb = "SELECT COUNT(*) AS total FROM tabel_pp WHERE Status_Berkas = 'SUDAH BTB'";
    $stmt_sudah_btb = $pdo->query($sql_sudah_btb);
    $total_sudah_btb = $stmt_sudah_btb->fetch(PDO::FETCH_ASSOC)['total'];

    $sql_terbentuk_pp = "SELECT COUNT(*) AS total FROM tabel_pp WHERE Status_Berkas = 'TERBENTUK PP'";
    $stmt_terbentuk_pp = $pdo->query($sql_terbentuk_pp);
    $total_terbentuk_pp = $stmt_terbentuk_pp->fetch(PDO::FETCH_ASSOC)['total'];

    $sql_terbentuk_sp = "SELECT COUNT(*) AS total FROM tabel_pp WHERE Status_Berkas = 'TERBENTUK SP'";
    $stmt_terbentuk_sp = $pdo->query($sql_terbentuk_sp);
    $total_terbentuk_sp = $stmt_terbentuk_sp->fetch(PDO::FETCH_ASSOC)['total'];

    $sql_register = "SELECT COUNT(*) AS total FROM tabel_pp WHERE Status_Berkas = 'UPLOAD FTP'";
    $stmt_register = $pdo->query($sql_register);
    $total_uploadftp = $stmt_register->fetch(PDO::FETCH_ASSOC)['total'];

    $sql_register = "SELECT COUNT(*) AS total FROM tabel_pp WHERE Status_Berkas = 'BARU'";
    $stmt_register = $pdo->query($sql_register);
    $total_baru = $stmt_register->fetch(PDO::FETCH_ASSOC)['total'];

} catch (PDOException $e) {
    $error_message = "Error fetching data: " . $e->getMessage();
    $total_pp = 0;
    $total_esign = 0;
    $total_reject = 0;
    $total_sudah_btb = 0;
    $total_terbentuk_pp = 0;
    $total_terbentuk_sp = 0;
    $total_uploadftp = 0;
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <h5 class="mb-2">Info Monitoring USULAN DAN PP CABANG <small><i>Silahkan cek secara berkala</i></small></h5>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $total_usulan; ?></h3>
                            <p>Total Usulan</p>
                        </div>
                        <a href="monitoring.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $total_pending; ?></h3>
                            <p>Pending Usulan</p>
                        </div>
                        <a href="monitoring.php?status=PENDING" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $total_approved; ?></h3>
                            <p>Approved Usulan</p>
                        </div>
                        <a href="monitoring.php?status=APPROVED" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $total_rejected; ?></h3>
                            <p>Rejected Usulan</p>
                        </div>
                        <a href="monitoring.php?status=REJECTED" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo $total_selesai; ?></h3>
                            <p>Selesai Usulan</p>
                        </div>
                        <a href="monitoring.php?status=SELESAI" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                 </div>
                

                <h5 class="mb-2">Info Monitoring PP HO <small><i>Silahkan cek secara berkala</i></small></h5>
                <!-- ./col -->
                <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $total_pp; ?></h3>
                            <p>Total PP</p>
                        </div>
                        <a href="monitoring_pp.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $total_esign; ?></h3>
                            <p>ESIGN</p>
                        </div>
                        <a href="monitoring_pp.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $total_reject; ?></h3>
                            <p>REJECT</p>
                        </div>
                        <a href="monitoring_pp.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $total_sudah_btb; ?></h3>
                            <p>SUDAH BTB</p>
                        </div>
                        <a href="monitoring_pp.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                 <!-- ./col -->
                 <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo $total_terbentuk_pp; ?></h3>
                            <p>TERBENTUK PP</p>
                        </div>
                        <a href="monitoring_pp.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                 <!-- ./col -->
                 <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3><?php echo $total_terbentuk_sp; ?></h3>
                            <p>TERBENTUK SP</p>
                        </div>
                        <a href="monitoring_pp.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                 <!-- ./col -->
                 <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3><?php echo $total_uploadftp; ?></h3>
                            <p>UPLOAD FTP</p>
                        </div>
                        <a href="monitoring_pp.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-black">
                        <div class="inner">
                            <h3><?php echo $total_baru; ?></h3>
                            <p>PP BARU</p>
                        </div>
                        <a href="monitoring_pp.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                 </div>

            </div>
            <!-- /.row -->
            <!-- Main row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>


