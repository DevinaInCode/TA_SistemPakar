<?php
// Untuk format G-
$query = mysqli_query($conn, "SELECT kdPenyakit FROM penyakit ORDER BY kdPenyakit DESC LIMIT 1");
$data = mysqli_fetch_array($query);

if ($data) {
  $lastNum = (int) str_replace('P-', '', $data['kdPenyakit']);
  $nextNum = $lastNum + 1;
} else {
  $nextNum = 1;
}

$newKd = 'P-' . str_pad($nextNum, 2, '0', STR_PAD_LEFT);

// Proses tambah data
// Mengambil data dr form
if (isset($_POST['simpan'])) {
  $id = $_POST['id'];
  $kode_penyakit = $_POST['kode_penyakit'];
  $nama_penyakit = $_POST['nama_penyakit'];
  $definisi = $_POST['definisi'];
  $solusi = $_POST['solusi'];
  $rek_obat = $_POST['rek_obat'];

  //proses simpan
  $sql = "INSERT INTO penyakit VALUES ('$id', '$kode_penyakit',
  '$nama_penyakit', '$definisi', '$solusi', '$rek_obat')";
  if ($conn->query($sql) === TRUE) {
    header("Location:?page=penyakit");
  }
}

?>


<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-warning text-white border-dark"><strong>Tambah Data Penyakit</strong></div>
          <div class="card-body">
            <div class="form-group">
              <input type="hidden" name="id">
            </div>
            <div class="form-group">
              <input type="hidden" name="kode_penyakit" value="<?= $newKd ?>">
            </div>
            <div class="form-group">
              <label for="">Nama Gejala</label>
              <input type="text" class="form-control" name="nama_penyakit" maxlength="50" required>
            </div>
            <div class="form-group">
              <label for="">Definisi</label>
              <textarea class="form-control" name="definisi" required></textarea>
            </div>
            <div class="form-group">
              <label for="">Solusi</label>
              <textarea class="form-control" name="solusi" required></textarea>
            </div>
            <div class="form-group">
              <label for="">Rekomendasi Obat</label>
              <textarea class="form-control" name="rek_obat" required></textarea>
            </div>

            <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
            <a class="btn btn-danger" href="?page=penyakit">Batal</a>

          </div>
        </div>
    </form>
  </div>
</div>