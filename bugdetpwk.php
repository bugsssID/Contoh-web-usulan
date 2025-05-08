<?php
include 'config.php';

// Fetch user data from user_dc table
$query = "SELECT plu, deskripsi, jan, feb, mar, apr, mei, jun, jul, aug, sep, okt, nov, des, total, harga_satuan, harga_total FROM bugdet";
$stmt = $pdo->query($query);

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
                    <h1 class="m-0">MONITORING BUDGET PURWAKARTA</h1>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DATA BUGDET PWK </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Plu</th>
                                        <th>Deskripsi</th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>Mei</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Aug</th>
                                        <th>Sept</th>
                                        <th>Okt</th>
                                        <th>Nov</th>
                                        <th>Des</th>
                                        <th>Total</th>
                                        <th>Harga Satuan</th>
                                        <th>Harga Total</th>
                                        </tr>
                                </thead>      
                                <tbody>
                        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?php echo $row['plu']; ?></td>
                                <td><?php echo $row['deskripsi']; ?></td>
                                <td><?php echo $row['jan']; ?></td>
                                <td><?php echo $row['feb']; ?></td>
                                <td><?php echo $row['mar']; ?></td>
                                <td><?php echo $row['apr']; ?></td>
                                <td><?php echo $row['mei']; ?></td>
                                <td><?php echo $row['jun']; ?></td>
                                <td><?php echo $row['jul']; ?></td>
                                <td><?php echo $row['aug']; ?></td>
                                <td><?php echo $row['sep']; ?></td>
                                <td><?php echo $row['okt']; ?></td>
                                <td><?php echo $row['nov']; ?></td>
                                <td><?php echo $row['des']; ?></td>
                                <td><?php echo $row['total']; ?></td>
                                <td><?php echo $row['harga_satuan']; ?></td>
                                <td><?php echo $row['harga_total']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                        </div>
                        </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>
