<?php
include "config.php";

// Cek apakah parameter GET tersedia
$id_problem = $_GET['id_problem'] ?? '';
$id_evidence = $_GET['id_evidence'] ?? '';

if (isset($_POST['submit'])) {
  // Ambil data dari form
  $cf = $_POST['cf'];

  // Query update
  $query = mysqli_query(
    $conn,
    "UPDATE rules 
     SET cf = '$cf' 
     WHERE id_problem = '$id_problem' AND id_evidence = '$id_evidence'"
  );

  if ($query) {
    header("Location: ?page=bAturan");
    exit; // Sangat penting agar tidak lanjut render
  } else {
    echo "Gagal update data!";
  }
} else {
  // Ambil data untuk ditampilkan di form
  $q = mysqli_query(
    $conn,
    "SELECT * FROM rules WHERE id_problem='$id_problem' AND id_evidence='$id_evidence'"
  );
  $row = mysqli_fetch_assoc($q);
}
?>

<!-- Form Update -->
<div class="row">
  <div class="col-sm-12">
    <form method="POST" action="">
      <div class="card border-dark">
        <div class="card-header bg-primary text-white border-dark">
          <strong>Update Data Aturan</strong>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="cf">Nilai CF</label>
            <input type="number" name="cf" step="0.1" min="0" max="1" value="<?= $row['cf']; ?>" required>
          </div>

          <input class="btn btn-primary" type="submit" name="submit" value="Update">
          <a class="btn btn-danger" href="?page=bAturan">Batal</a>
        </div>
      </div>
    </form>
  </div>
</div>