<!-- Update -->
<?php
// Mengambil id dr parameter
$id = $_GET['id'];

if (isset($_POST['update'])) {
  $nama_penyakit = $_POST['nama_penyakit'];
  $deskripsi = $_POST['definisi'];
  $solusi = $_POST['solusi'];
  $rek_obat = $_POST['rek_obat'];

  // proses update
  $sql = "UPDATE penyakit SET nmPenyakit='$nama_penyakit', definisi='$definisi', 
  solusi='$solusi', rek_obat='$rek_obat'  WHERE id ='$id'";

  if ($conn->query($sql) === TRUE) {
    header("Location:?page=penyakit");
  }
}

$sql = "SELECT * FROM penyakit WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-primary text-white border-dark"><strong>Update Data Gejala</strong></div>
          <div class="card-body">

            <div class="form-group">
              <label for="">Nama Gejala</label>
              <input type="text" class="form-control" value="<?php echo $row['nmPenyakit'] ?>" name="nama_penyakit" maxlength="50" required>
            </div>
            <div class="form-group">
              <label for="">Definisi</label>
              <textarea class="form-control" name="definisi" required><?php echo $row['definisi'] ?></textarea>
            </div>
            <div class="form-group">
              <label for="">Solusi</label>
              <textarea class="form-control" name="solusi" required><?php echo $row['solusi'] ?></textarea>
            </div>
            <div class="form-group">
              <label for="">Rekomendasi Obat</label>
              <textarea class="form-control" name="rek_obat" required><?php echo $row['rek_obat'] ?></textarea>
            </div>

            <input class="btn btn-primary" type="submit" name="update" value="Update">
            <a class="btn btn-danger" href="?penyakit">Batal</a>

          </div>
        </div>
    </form>
  </div>
</div>