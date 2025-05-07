<?php
include "config.php";
$id_problem = $_GET['id_problem'];
$id_evidence = $_GET['id_evidence'];
$query = mysqli_query($conn, "DELETE FROM rules WHERE id_problem='$id_problem' AND id_evidence='$id_evidence'");
if ($query) {
  // Redirect kembali ke halaman daftar rules
  header("Location: ?page=bAturan");
} else {
  echo "Gagal menghapus data!";
}
