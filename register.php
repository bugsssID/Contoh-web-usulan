<?php
include 'config.php';

if (isset($_SESSION['nik']) && $_SESSION['nik'] == true) {
    //  echo "Welcome to the member's area, " . $_SESSION['AKSES'] . "!";
  } else {
      echo"<script> window.location.href = 'login.php' ; </script>";
      exit;
  }

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST['nik'];
    $username = $_POST['username'];
    $bagian = $_POST['bagian'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($nik && $username && $role && $password && $bagian) {
        $sql = "INSERT INTO user_dc (nik, username, role, pass, bagian) VALUES (:nik, :username, :role, :pass, :bagian)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nik', $nik);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':pass', $hashed_password);
        $stmt->bindParam(':bagian', $bagian);

        if ($stmt->execute()) {
            $success_message = "User registered successfully";
        } else {
            $error_message = "Error: " . $sql . "<br>" . $stmt->errorInfo();
        }
    } else {
        $error_message = "Please fill in all required fields.";
    }
}

include('header.php');
include('navbar.php');
include('sidebar.php');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar User</h1>
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
        <div class="col-lg-3 col-6">
            <!-- Small boxes (Stat box) -->
    <!-- /.register-logo -->
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new user</p>

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

            <form action="register.php" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="nik" class="form-control" placeholder="NIK" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-id-card"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <select name="role" class="form-control" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user-tag"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    </div>
                <div class="input-group mb-3">
                                <select id="bagian" name="bagian" class="form-control" required placeholder="Bagian">
                                    <option value="WAREHOUSE">WAREHOUSE</option>
                                    <option value="ISSUING">ISSUING</option>
                                    <option value="DELIVERY">DELIVERY</option>
                                    <option value="PERISHABLE">PERISHABLE</option>
                                    <option value="ADMIN">ADMIN</option>
                                    <option value="RETUR">RETUR</option>
                                    <option value="RECEIVING">RECEIVING</option>
                                </select>           
                                <div class="input-group-append">
                             <div class="input-group-text">
                            <span class="fas fa-home"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->
 </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>
