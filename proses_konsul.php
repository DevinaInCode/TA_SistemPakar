<?php
include 'config.php';

// Cek apakah gejala dipilih

if (!isset($_POST['gejala'])) {
  echo '<div class="container mt-4">
          <div class="alert alert-danger" role="alert">
            <strong>Oops!</strong> Silakan pilih minimal satu gejala sebelum melanjutkan konsultasi.
          </div>
        </div>';
  exit;
}

$gejalaDipilih = $_POST['gejala']; // Array id_gejala yang dipilih user
$hasilDiagnosa = []; // Untuk menyimpan daftar cf per penyakit

// Ambil aturan dari gejala yang dipilih (Forward Chaining)
foreach ($gejalaDipilih as $id_gejala) {
  $query = mysqli_query($conn, "SELECT * FROM rules WHERE id_evidence = '$id_gejala'");

  while ($row = mysqli_fetch_array($query)) {
    $id_penyakit = $row['id_problem'];
    $cf_pakar = $row['cf'];

    // Kelompokkan berdasarkan penyakit
    if (!isset($hasilDiagnosa[$id_penyakit])) {
      $hasilDiagnosa[$id_penyakit] = [];
    }

    $hasilDiagnosa[$id_penyakit][] = $cf_pakar;
  }
}

// Hitung CF Combine per penyakit
$cfCombine = [];

foreach ($hasilDiagnosa as $id_penyakit => $listCF) {
  $cfCombine[$id_penyakit] = $listCF[0];

  for ($i = 1; $i < count($listCF); $i++) {
    $cfCombine[$id_penyakit] = $cfCombine[$id_penyakit] + $listCF[$i] * (1 - $cfCombine[$id_penyakit]);
  }
}

// Urutkan berdasarkan nilai CF tertinggi
arsort($cfCombine);

// Tampilkan hasil diagnosa
echo "<h4>Hasil Diagnosa:</h4>";

if (empty($cfCombine)) {
  echo '<div class="container mt-4">
          <div class="alert alert-warning" role="alert">
            <strong>Oops!</strong> Tidak ditemukan kemungkinan penyakit berdasarkan gejala yang dipilih.
          </div>
        </div>';
} else {
  foreach ($cfCombine as $id_penyakit => $cf) {
    $qPenyakit = mysqli_query($conn, "SELECT * FROM penyakit WHERE id = '$id_penyakit'");
    $dPenyakit = mysqli_fetch_array($qPenyakit);

    echo "<div class='alert alert-info'>";
    echo "<strong>{$dPenyakit['nmPenyakit']}</strong><br>";
    echo "Kode: {$dPenyakit['kdPenyakit']}<br>";
    echo "Nilai CF: <strong>" . round($cf, 3) . "</strong>";
    echo "</div>";
  }
}
