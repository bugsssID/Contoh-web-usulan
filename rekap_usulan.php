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


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data dari form
            $iddc = !empty($_POST['iddc']) ? $_POST['iddc'] : null;
            $tanggal = !empty($_POST['tanggal']) ? $_POST['tanggal'] : null;
            $tujuan = isset($_POST['tujuan']) ? implode(", ", $_POST['tujuan']) : null; // Gabungkan item menjadi string
            $bagian = isset($_POST['bagian']) ? implode(", ", $_POST['bagian']) : null; // Gabungkan bagian menjadi string
            $deskripsi = !empty($_POST['deskripsi']) ? $_POST['deskripsi'] : null;
            $keter = !empty($_POST['keter']) ? $_POST['keter'] : null;

            // Validasi data
            if ($iddc && $tanggal && $tujuan && $bagian && $deskripsi && $keter) {
                // Koneksi ke database (gunakan PDO atau library database CodeIgniter)
                try {
                    // Query untuk menyimpan data
                    $sql = "INSERT INTO tabel_usulan_dc (
                               iddc, tanggal, tujuan, bagian, deskripsi, keter
                            ) VALUES (
                                :iddc, :tanggal, :tujuan, :bagian, :deskripsi, :keter
                            )";

                    // Persiapkan statement
                    $stmt = $pdo->prepare($sql);

                    // Bind parameter
                    $stmt->bindParam(':iddc', $iddc);
                    $stmt->bindParam(':tanggal', $tanggal);
                    $stmt->bindParam(':tujuan', $tujuan);
                    $stmt->bindParam(':bagian', $bagian);
                    $stmt->bindParam(':deskripsi', $deskripsi);
                    $stmt->bindParam(':keter', $keter);

                    // Eksekusi query
                    if ($stmt->execute()) {
                        // Tampilkan pesan sukses dengan SweetAlert
                        echo '<script>
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil!",
                                text: "Data berhasil disimpan.",
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        </script>';
                    } else {
                        // Tampilkan pesan error dengan SweetAlert
                        $error_message = "Gagal menyimpan data: " . $stmt->errorInfo()[2];
                        echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "' . addslashes($error_message) . '"
                            });
                        </script>';
                    }
                } catch (Exception $e) {
                    // Tampilkan pesan error dengan SweetAlert
                    $error_message = "Error: " . $e->getMessage();
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "' . addslashes($error_message) . '"
                        });
                    </script>';
                }
            } else {
                // Tampilkan pesan validasi error dengan SweetAlert
                $error_message = "Harap lengkapi semua field yang wajib diisi.";
                echo '<script>
                    Swal.fire({
                        icon: "warning",
                        title: "Peringatan!",
                        text: "' . addslashes($error_message) . '"
                    });
                </script>';
            }
        }
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Rekap Usulan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Rekap Usulan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">REKAP USULAN KE DC</h3>
                        </div>
                        <div class="card-body">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form-horizontal">
                            <!-- ID DC -->
                            <div class="form-group row">
                                <label for="iddc" class="col-sm-2 col-form-label">ID DC:</label>
                                <div class="col-sm-4">
                                    <input type="text" id="iddc" name="iddc" class="form-control" placeholder="Masukkan ID DC" required>
                                </div>
                            </div>

                            <!-- Tanggal -->
                            <div class="form-group row">
                                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal:</label>
                                <div class="col-sm-4">
                                    <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                                </div>
                            </div>


                            <!-- Item BMT, GA, EDP -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tujuan:</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="bmt" name="tujuan[]" value="BMT">
                                        <label class="form-check-label" for="bmt">BMT</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="ga" name="tujuan[]" value="GA">
                                        <label class="form-check-label" for="ga">GA</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="edp" name="tujuan[]" value="EDP">
                                        <label class="form-check-label" for="edp">EDP</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Bagian RECEIVING, CCTV DC, dll. -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Bagian:</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="receiving" name="bagian[]" value="RECEIVING">
                                        <label class="form-check-label" for="receiving">RECEIVING</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="cctv_dc" name="bagian[]" value="CCTV DC">
                                        <label class="form-check-label" for="cctv_dc">CCTV DC</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="support_dc" name="bagian[]" value="SUPPORT DC">
                                        <label class="form-check-label" for="support_dc">SUPPORT DC</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="issuing" name="bagian[]" value="ISSUING">
                                        <label class="form-check-label" for="issuing">ISSUING</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="retur" name="bagian[]" value="RETUR">
                                        <label class="form-check-label" for="retur">RETUR</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="warehouse" name="bagian[]" value="WAREHOUSE">
                                        <label class="form-check-label" for="warehouse">WAREHOUSE</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="perishable" name="bagian[]" value="PERISHABLE">
                                        <label class="form-check-label" for="perishable">PERISHABLE</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="delivery" name="bagian[]" value="DELIVERY">
                                        <label class="form-check-label" for="delivery">DELIVERY</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="admin_gps" name="bagian[]" value="ADMIN GPS">
                                        <label class="form-check-label" for="admin_gps">ADMIN GPS</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="admin_dc" name="bagian[]" value="ADMIN DC">
                                        <label class="form-check-label" for="admin_dc">ADMIN DC</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="form-group row">
                                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi:</label>
                                <div class="col-sm-8">
                                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" placeholder="Masukkan deskripsi"></textarea>
                                </div>
                            </div>

                            <!-- Keterangan -->
                            <div class="form-group row">
                                <label for="keter" class="col-sm-2 col-form-label">Keterangan:</label>
                                <div class="col-sm-8">
                                    <textarea id="keter" name="keter" class="form-control" rows="3" placeholder="Masukkan keterangan"></textarea>
                                </div>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>

 </section>
            <!-- /.content -->
        </div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>


