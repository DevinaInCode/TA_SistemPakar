<?php
include 'config.php';
// Proses tambah data
// Mengambil data dr form
if (isset($_POST['simpan'])) {
  $id_problem = $_POST['id_problem'];
  $id_evidence = $_POST['id_evidence'];
  $cf = $_POST['cf'];

  //Mengecek apakah ada data aturan yang duplikat
  $cek = mysqli_query($conn, "SELECT * FROM rules WHERE id_problem='$id_problem' AND id_evidence='$id_evidence'");
  if (mysqli_num_rows($cek) > 0) {
    echo "<script>
    alert('Aturan dengan kombinasi ini sudah ada!');
    window.location.href='?page=bAturan';
  </script>";
    exit;
  }
  //Insert ke Table
  $query = mysqli_query($conn, "INSERT INTO rules (id_problem, id_evidence, cf) VALUES ('$id_problem', '$id_evidence', '$cf')");

  if ($query) {
    echo "<script>
            alert('Data berhasil disimpan!');
            window.location.href='?page=bAturan';
          </script>";
  } else {
    echo "<script>
            alert('Gagal menyimpan data!');
            window.location.href='?page=bAturan';
          </script>";
  }
}

?>


<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-warning text-white border-dark"><strong>Tambah Basis Aturan</strong></div>
          <div class="card-body">
            <div class="form-group">
              <select name="id_problem" required>
                <option value="">Pilih Penyakit</option>
                <?php
                $qry = mysqli_query($conn, "SELECT * FROM penyakit");
                while ($row = mysqli_fetch_assoc($qry)) {
                  echo "<option value='{$row['id']}'>{$row['kdPenyakit']} - {$row['nmPenyakit']}</option>";
                }
                ?>
              </select>
              <br><br>
            </div>
            <div class="form-group">
              <select name="id_evidence" required>
                <option value="">Pilih Gejala</option>
                <?php
                $qry = mysqli_query($conn, "SELECT * FROM gejala");
                while ($row = mysqli_fetch_assoc($qry)) {
                  echo "<option value='{$row['id_gejala']}'>{$row['kode_gejala']} - {$row['nama_gejala']}</option>";
                }
                ?>
              </select>
              <br><br>
            </div>
            <div class="form-group">
              <label for="">Nilai CF (0.0 - 1.0)</label>
              <input type="number" name="cf" step="0.1" min="0" max="1" required>
            </div>

            <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
            <a class="btn btn-danger" href="?page=bAturan">Batal</a>

          </div>
        </div>
    </form>
  </div>
</div>