<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Basis Aturan</title>

  <!-- bootstrap css -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- datatables css -->
  <link rel="stylesheet" href="assets/css/datatables.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/css/all.css">
</head>

<body>
  <div class="card">
    <div class="card-header bg-primary text-white border-dark"><strong>Data Basis Aturan</strong></div>
    <div class="card-body">
      <a class="btn btn-primary mb-2" href="?page=bAturan&action=tambah">
        <i class="fas fa-plus"></i>
      </a>
      <table class="table table-bordered" id="ourTable">
        <thead>
          <tr>
            <th width="40px">No</th>
            <th width="100px">Penyakit</th>
            <th width="500px">Gejala</th>
            <th width="150px">Nilai CF</th>
            <th width="150px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include "config.php";
          $no = 1;
          $sql = mysqli_query($conn, "
          SELECT rules.id_problem, rules.id_evidence, rules.cf,
                 penyakit.nmPenyakit, gejala.nama_gejala
          FROM rules
          JOIN penyakit ON rules.id_problem = penyakit.id
          JOIN gejala ON rules.id_evidence = gejala.id_gejala
        ");
          while ($row = $sql->fetch_assoc()) {
          ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $row['nmPenyakit']; ?></td>
              <td><?php echo $row['nama_gejala']; ?></td>
              <td><?php echo $row['cf']; ?></td>
              <td align="center">
                <a class="btn btn-warning btn-sm"
                  href="?page=bAturan&action=update&id_problem=<?= $row['id_problem']; ?>&id_evidence=<?= $row['id_evidence']; ?>">
                  <i class="fas fa-edit"></i>
                </a>

                <a onclick="return confirm('Yakin menghapus data ini ?')"
                  class="btn btn-danger btn-sm"
                  href="?page=bAturan&action=hapus&id_problem=<?= $row['id_problem']; ?>&id_evidence=<?= $row['id_evidence']; ?>">
                  <i class="fas fa-trash"></i>
                </a>

              </td>
            </tr>
          <?php
          }
          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- jquery -->
  <script src="assets/js/jquery-3.7.0.min.js"></script>
  <!-- bootstrap js -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- DataTable js -->
  <script src="assets/js/datatables.min.js"></script>
  <!-- Font Awesome 5 -->
  <script src="assets/js/all.js"></script>

</body>

</html>