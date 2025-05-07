<?php
//koneksi database
include "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Pakar Kelompok 4</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- Bootstrap Table -->
  <link rel="stylesheet" href="assets/css/datatables.min.css">
  <!-- Font Awesome 5  -->
  <link rel="stylesheet" href="assets/css/all.css">
</head>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-sm bg-warning navbar-dark">
    <div class="container-fluid">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="?page=gejala">Gejala</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="?page=penyakit">Penyakit</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="?page=bAturan">Basis Pengetahuan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="?page=konsul">Konsultasi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- container -->
  <div class="container">
    <h1></h1>
    <p></p>
  </div>

  <!-- Container -->
  <div class="container mt-2">
    <!-- Menu -->
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : "";
    $action = isset($_GET['action']) ? $_GET['action'] : "";

    if ($page == "") {
      include "welcome.php";
    } elseif ($page == "gejala") {
      if ($action == "") {
        include "view_gejala.php";
      } elseif ($action == "tambah") {
        include "add_gejala.php";
      } elseif ($action == "update") {
        include "upd_gejala.php";
      } else {
        include "del_gejala.php";
      }
    } elseif ($page == "penyakit") {
      if ($action == "") {
        include "view_penyakit.php";
      } elseif ($action == "tambah") {
        include "add_penyakit.php";
      } elseif ($action == "update") {
        include "upd_penyakit.php";
      } else {
        include "del_penyakit.php";
      }
    } elseif ($page == "bAturan") {
      if ($action == "") {
        include "view_bAturan.php";
      } elseif ($action == "tambah") {
        include "add_bAturan.php";
      } elseif ($action == "update") {
        include "upd_bAturan.php";
      } else {
        include "del_bAturan.php";
      }
    } elseif ($page == "konsul") {
      if ($action == "") {
        include "view_konsul.php";
      } elseif ($action == "proses") {
        include "proses_konsul.php";
      } elseif ($action == "riwayat") {
        include "riwayat_konsul.php";
      } else {
        include "del_konsul.php";
      }
    } else {
      // include "rules";
    }
    ?>
  </div>

  <!-- jquery -->
  <script src="assets/js/jquery-3.7.0.min.js"></script>
  <!-- Bootstrap js -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- Datatables js -->
  <script src="assets/js/datatables.min.js"></script>
  <!-- Font Awesome 5 -->
  <script src="assets/js/all.js"></script>



  <!-- Script js -->
  <script>
    $(document).ready(function() {
      $('#ourTable').DataTable();
    });
  </script>
</body>

</html>