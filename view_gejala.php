<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

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
      <a class="btn btn-primary mb-2" href="?page=gejala&action=tambah">
        <i class="fas fa-plus"></i>
      </a>
      <table class="table table-bordered" id="ourTable">
        <thead>
          <tr>
            <th width="40px">No.</th>
            <th width="100px">Kode Gejala</th>
            <th width="500px">Nama Gejala</th>
            <th width="150px"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sql = "SELECT*FROM gejala";
          $result = $conn->query($sql);
          while ($row = $result->fetch_assoc()) {
          ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $row['kode_gejala']; ?></td>
              <td><?php echo $row['nama_gejala']; ?></td>
              <td align="center">
                <a class="btn btn-warning" href="?page=gejala&action=update&id_gejala=
                <?php echo $row['id_gejala']; ?>">
                  <i class="fas fa-edit"></i>
                </a>
                <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger"
                  href="?page=gejala&action=hapus&id_gejala=<?php echo $row['id_gejala']; ?>">
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