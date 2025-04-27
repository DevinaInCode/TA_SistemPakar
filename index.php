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
          <a class="nav-link" href="?page=gejala">Gejala</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Penyakit</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Basis Aturan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Konsultasi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Logout</a>
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
        include "tampil_gejala.php";
      } elseif ($action == "NAMA_ACTION") {
        include "NAMA_HALAMAN";
      } elseif ($action == "NAMA_ACTION") {
        include "NAMA_HALAMAN";
      } else {
        include "NAMA_HALAMAN";
      }
    } else {
      include "NAMA_HALAMAN";
    }
    ?>
  </div>

  <!-- jquery -->
  <link rel="stylesheet" href="assets/js/jquery-3.7.0.min.js">
  <!-- Bootstrap js -->
  <link rel="stylesheet" href="assets/js/bootstrap.min.js">
</body>

</html>