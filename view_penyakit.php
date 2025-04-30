<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Penyakit & Obat</title>

  <!-- bootstrap css -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- datatables css -->
  <link rel="stylesheet" href="assets/css/datatables.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/css/all.css">
</head>

<body>
  <div class="card">
    <div class="card-header bg-primary text-white border-dark"><strong>Data Gejala</strong></div>
    <div class="card-body">
      <a class="btn btn-primary mb-2" href="?page=penyakit&action=tambah">
        <i class="fas fa-plus"></i>
      </a>
      <table class="table table-bordered" id="ourTable">
        <thead>
          <tr>
            <th width="40px">No.</th>
            <th width="100px">Kode Penyakit</th>
            <th width="500px">Nama Penyakit</th>
            <th width="150px">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT*FROM penyakit";
          $result = $conn->query($sql);
          while ($row = $result->fetch_assoc()) {
          ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['kdPenyakit']; ?></td>
              <td><?php echo $row['nmPenyakit']; ?></td>
              <td><?php echo $row['deskripsi']; ?></td>
              <td><?php echo $row['rek_obat']; ?></td>
              <td align="center">
                <a class="btn btn-warning" href="?page=penyakit&action=update&id_penyakit=
                <?php echo $row['id']; ?>">
                  <i class="fas fa-edit"></i>
                </a>
                <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger"
                  href="?page=penyakit&action=hapus&id_penyakit=<?php echo $row['id_penyakit']; ?>">
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