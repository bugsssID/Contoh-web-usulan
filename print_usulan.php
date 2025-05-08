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


?>
<html>
 <head>
  <title>
   Formulir Permohonan
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
 </head>
 <body class="bg-white p-8">
  <div class="max-w-4xl mx-auto border border-black p-4">
   <div class="flex justify-between items-center mb-4">
    <img alt="Indomaret logo" class="h-12" height="50" src="https://storage.googleapis.com/a1aa/image/SFltyjepUXYzUliyo5xXL7rp82m1xP3pS6JU8aGUkWE.jpg" width="100"/>
    <div class="text-right">
     <p class="text-sm">
      882/DC-PWK/12/2024
     </p>
     <p class="text-sm">
      Dept : CCTV DC
     </p>
    </div>
   </div>
   <h1 class="text-center font-bold text-lg mb-4">
    Formulir Permohonan
    <br/>
    ( Perbaikan / Usulan )
   </h1>
   <div class="mb-4">
    <p class="text-sm">
     Ditujuakan : BMT Cabang
    </p>
   </div>
   <table class="w-full border-collapse border border-black text-sm mb-4">
    <thead>
     <tr>
      <th class="border border-black p-2">
       No
      </th>
      <th class="border border-black p-2">
       Tanggal
      </th>
      <th class="border border-black p-2">
       Keterangan
      </th>
      <th class="border border-black p-2">
       Ket
      </th>
     </tr>
    </thead>
    <tbody>
     <tr>
      <td class="border border-black p-2">
        1
      </td>
      <td class="border border-black p-2">
       14-Dec-24
      </td>
      <td class="border border-black p-2">
       Usulan penambahan terminal untuk power cctv baru.
      </td>
      <td class="border border-black p-2">
       Penambahan cctv baru
      </td>
     </tr>
     <tr>
      <td class="border border-black p-2">
      </td>
      <td class="border border-black p-2">
      </td>
      <td class="border border-black p-2">
       total 1 terminal
      </td>
      <td class="border border-black p-2">
      </td>
     </tr>
     <tr>
      <td class="border border-black p-2">
      </td>
      <td class="border border-black p-2">
      </td>
      <td class="border border-black p-2">
       Total cctv 1 unit
      </td>
      <td class="border border-black p-2">
      </td>
     </tr>
     <tr>
      <td class="border border-black p-2">
      </td>
      <td class="border border-black p-2">
      </td>
      <td class="border border-black p-2">
       Kebutuhan
      </td>
      <td class="border border-black p-2">
      </td>
     </tr>
     <tr>
      <td class="border border-black p-2">
      </td>
      <td class="border border-black p-2">
      </td>
      <td class="border border-black p-2">
       * kabel power UTM sudah ada
      </td>
      <td class="border border-black p-2">
      </td>
     </tr>
     <tr>
      <td class="border border-black p-2">
      </td>
      <td class="border border-black p-2">
      </td>
      <td class="border border-black p-2">
       * 1 unit terminal 2 lubang
      </td>
      <td class="border border-black p-2">
      </td>
     </tr>
    </tbody>
   </table>
   <div class="text-right mb-4">
    <p class="text-sm">
     Purwakarta, <?php echo $row['tgl_dibuat']; ?>
    </p>
   </div>
   <div class="flex justify-between text-center text-sm">
    <div>
     <p>
      Disetujui,
     </p>
     <div class="h-16">
     </div>
     <p>
      ( BM/DBM )
     </p>
    </div>
    <div>
     <p>
      Mengetahui,
     </p>
     <div class="h-16">
     </div>
     <p>
      ( BMT MGR )
     </p>
    </div>
    <div>
     <p>
      Mengetahui,
     </p>
     <div class="h-16">
     </div>
     <p>
      ( DCM/DDCM )
     </p>
    </div>
    <div>
     <p>
      Diajukan,
     </p>
     <div class="h-16">
     </div>
     <p>
      ( Supervisor )
     </p>
    </div>
   </div>
  </div>
 </body>
</html>
