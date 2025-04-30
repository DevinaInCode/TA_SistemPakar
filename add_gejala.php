<?php
// Untuk format G-
$query = mysqli_query($conn, "SELECT kode_gejala FROM gejala ORDER BY kode_gejala DESC LIMIT 1");
$data = mysqli_fetch_array($query);

if ($data) {
  $lastNum = (int) str_replace('G-', '', $data['kode_gejala']);
  $nextNum = $lastNum + 1;
} else {
  $nextNum = 1;
}

$newKd = 'G-' . str_pad($nextNum, 2, '0', STR_PAD_LEFT);


// Proses tambah data
// Mengambil data dr form
if (isset($_POST['simpan'])) {
  $id_gejala = $_POST['no'];
  $kode_gejala = $_POST['kode_gejala'];
  $nama_gejala = $_POST['nama_gejala'];


  //proses simpan
  $sql = "INSERT INTO gejala VALUES ('$id_gejala', '$kode_gejala','$nama_gejala')";
  if ($conn->query($sql) === TRUE) {
    header("Location:?page=gejala");
  }
}

?>


<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-warning text-white border-dark"><strong>Tambah Data Gejala</strong></div>
          <div class="card-body">
            <div class="form-group">
              <input type="hidden" name="id_gejala">
            </div>
            <div class="form-group">
              <input type="hidden" name="kode_gejala" value="<?= $newKd ?>">
            </div>
            <div class="form-group">
              <label for="">Nama Gejala</label>
              <input type="text" class="form-control" name="nama_gejala" maxlength="200" required>
            </div>

            <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
            <a class="btn btn-danger" href="?page=gejala">Batal</a>

          </div>
        </div>
    </form>
  </div>
</div>