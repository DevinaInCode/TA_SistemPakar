<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Konsultasi</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="assets/css/datatables.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/css/all.css">
</head>

<body>
  <div class="container mt-4">
    <div class="card shadow">
      <div class="card-header bg-primary text-white border-dark">
        <strong>Data Konsultasi</strong>
      </div>
      <div class="card-body">

        <!-- Form Pilihan Gejala -->
        <form action="?page=konsul&action=proses" method="post">
          <h5 class="mb-3">Pilih Gejala yang Kucing Anda Alami:</h5>
          <?php
          include 'config.php';
          $query = mysqli_query($conn, "SELECT * FROM gejala");
          while ($data = mysqli_fetch_array($query)) {
            echo "<div class='form-check'>
                    <input class='form-check-input' type='checkbox' name='gejala[]' value='{$data['id_gejala']}' id='g{$data['id_gejala']}'>
                    <label class='form-check-label' for='g{$data['id_gejala']}'>
                      {$data['kode_gejala']} - {$data['nama_gejala']}
                    </label>
                  </div>";
          }
          ?>
          <button class="btn btn-success mt-3" type="submit">
            <i class="fas fa-stethoscope"></i> Proses Diagnosa
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- JS Libraries -->
  <script src="assets/js/jquery-3.7.0.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/datatables.min.js"></script>
  <script src="assets/js/all.js"></script>

  <script>
    // Inisialisasi DataTable
    $(document).ready(function() {
      $('#ourTable').DataTable();
    });
  </script>
</body>

</html>