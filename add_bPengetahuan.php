<?php
// Koneksi ke database
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Ambil data dari form
  $kdPenyakit = $_POST['kdPenyakit'];  // Pastikan ini adalah id yang valid dari tabel penyakit
  $kode_gejala = $_POST['kode_gejala'];
  $cf = $_POST['cf'];

  // Cek apakah id_gejala ada di tabel gejala
  $checkQuery = "SELECT * FROM gejala WHERE id_gejala = '$kode_gejala'";
  $checkResult = $conn->query($checkQuery);

  if ($checkResult->num_rows > 0) {
    // Jika id_gejala ada, lanjutkan memasukkan data ke rules
    $sql = "INSERT INTO rules (id, id_gejala, cf) VALUES ('$kdPenyakit', '$kode_gejala', '$cf')";

    if ($conn->query($sql) === TRUE) {
      echo "Data berhasil disimpan!";
      // Redirect ke halaman data setelah berhasil menyimpan
      header("Location: ?page=bPengetahuan");
      exit();
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  } else {
    echo "Gejala dengan kode tersebut tidak ada!";
  }
}
?>

<div class="row">
  <div class="col-sm-12">
    <form method="POST" action="add_bPengetahuan.php">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-warning text-white border-dark">
            <strong>Tambah Data Gejala</strong>
          </div>
          <div class="card-body">

            <!-- Penyakit Dropdown -->
            <div class="form-group">
              <label for="kdPenyakit">Pilih Penyakit:</label>
              <select name="kdPenyakit" id="kdPenyakit" class="form-control" required>
                <?php
                // Ambil data penyakit untuk dropdown
                $penyakitQuery = "SELECT id, nmPenyakit FROM penyakit";
                $penyakitResult = $conn->query($penyakitQuery);
                while ($penyakit = $penyakitResult->fetch_assoc()) {
                  echo "<option value='" . $penyakit['id'] . "'>" . $penyakit['nmPenyakit'] . "</option>";
                }
                ?>
              </select>
            </div>

            <!-- Gejala Dropdown -->
            <div class="form-group">
              <label for="kode_gejala">Pilih Gejala:</label>
              <select name="kode_gejala" id="kode_gejala" class="form-control" required>
                <?php
                // Ambil data gejala untuk dropdown
                $gejalaQuery = "SELECT id_gejala, nama_gejala FROM gejala";
                $gejalaResult = $conn->query($gejalaQuery);
                while ($gejala = $gejalaResult->fetch_assoc()) {
                  echo "<option value='" . $gejala['id_gejala'] . "'>" . $gejala['nama_gejala'] . "</option>";
                }
                ?>
              </select>
            </div>

            <!-- CF Input -->
            <div class="form-group">
              <label for="cf">CF:</label>
              <input type="number" step="0.01" name="cf" id="cf" class="form-control" required>
            </div>

            <!-- Submit and Cancel Buttons -->
            <button type="submit" class="btn btn-primary">Tambah Data</button>
            <a class="btn btn-danger" href="?page=bPengetahuan">Batal</a>

          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- bootstrap js -->
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>