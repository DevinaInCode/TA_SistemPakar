<!-- Update -->
<?php
// Mengambil id dr parameter
$id_gejala = $_GET['id_gejala'];

if (isset($_POST['update'])) {
  $nama_gejala = $_POST['nama_gejala'];

  // proses update
  $sql = "UPDATE gejala SET nama_gejala='$nama_gejala' WHERE id_gejala ='$id_gejala'";
  if ($conn->query($sql) === TRUE) {
    header("Location:?page=gejala");
  }
}

$sql = "SELECT * FROM gejala WHERE id_gejala='$id_gejala'";
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
              <input type="text" class="form-control" value="<?php echo $row['nama_gejala'] ?>" name="nama_gejala" maxlength="" required>
            </div>

            <input class="btn btn-primary" type="submit" name="update" value="Update">
            <a class="btn btn-danger" href="?gejala">Batal</a>

          </div>
        </div>
    </form>
  </div>
</div>