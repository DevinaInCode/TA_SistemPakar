<?php
include 'config.php';

// Validasi input gejala
if (!isset($_POST['gejala'])) {
  echo '<div class="container mt-4">
          <div class="alert alert-danger" role="alert">
            <strong>Oops!</strong> Silakan pilih minimal satu gejala sebelum melanjutkan konsultasi.
          </div>
        </div>';
  exit;
}

$gejalaDipilih = $_POST['gejala']; // Array id_gejala
$hasilDiagnosa = []; // Menyimpan CF tiap penyakit

// Proses Forward Chaining: Ambil aturan berdasarkan gejala yang dipilih
foreach ($gejalaDipilih as $id_gejala) {
  $query = mysqli_query($conn, "SELECT * FROM tb_rules WHERE id_evidence = '$id_gejala'");

  while ($row = mysqli_fetch_array($query)) {
    $id_penyakit = $row['id_problem'];
    $cf_pakar = $row['cf'];

    if (!isset($hasilDiagnosa[$id_penyakit])) {
      $hasilDiagnosa[$id_penyakit] = [];
    }

    $hasilDiagnosa[$id_penyakit][] = $cf_pakar;
  }
}

// Hitung CF Combine untuk masing-masing penyakit
$cfCombine = [];

foreach ($hasilDiagnosa as $id_penyakit => $listCF) {
  $cfCombine[$id_penyakit] = $listCF[0];

  for ($i = 1; $i < count($listCF); $i++) {
    $cfCombine[$id_penyakit] = $cfCombine[$id_penyakit] + $listCF[$i] * (1 - $cfCombine[$id_penyakit]);
  }
}

// Urutkan dari yang paling besar CF-nya
arsort($cfCombine);

// Ambil nama penyakit dan tampilkan
echo '<div class="container mt-5">
        <div class="card shadow">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Hasil Diagnosa</h4>
          </div>
          <div class="card-body">';

if (empty($cfCombine)) {
  echo "<div class='alert alert-warning'>Tidak ditemukan kemungkinan penyakit berdasarkan gejala yang dipilih.</div>";
} else {
  $hasilDiagnosaText = ''; // Menyimpan hasil dalam format text untuk disimpan ke riwayat

  foreach ($cfCombine as $id_penyakit => $cf) {
    $qPenyakit = mysqli_query($conn, "SELECT * FROM penyakit WHERE id = '$id_penyakit'");
    $dPenyakit = mysqli_fetch_array($qPenyakit);

    echo "<div class='alert alert-info'>
            <h5 class='mb-1'>{$dPenyakit['nmPenyakit']}</h5>
            <p class='mb-1'>Kode: <strong>{$dPenyakit['kdPenyakit']}</strong></p>
            <p class='mb-0'>Nilai CF: <strong>" . round($cf, 3) . "</strong></p>
          </div>";

    // Menyimpan hasil diagnosa untuk riwayat
    $hasilDiagnosaText .= $dPenyakit['nmPenyakit'] . " (CF: " . round($cf, 3) . "), ";
  }

  // Hapus koma dan spasi terakhir
  $hasilDiagnosaText = rtrim($hasilDiagnosaText, ', ');

  // Simpan riwayat konsultasi ke database
  // Misalnya user_id diambil dari session atau form
  $user_id = 1; // Gantilah sesuai kebutuhan, misalnya dari session

  $gejalaText = implode(", ", $gejalaDipilih); // Menyimpan gejala dalam bentuk teks

  $insertRiwayat = mysqli_query($conn, "INSERT INTO riwayat_konsultasi (user_id, gejala, hasil_diagnosa, nilai_cf)
                                       VALUES ('$user_id', '$gejalaText', '$hasilDiagnosaText', '" . implode(", ", $cfCombine) . "')");
  if ($insertRiwayat) {
    echo "<div class='alert alert-success'>Riwayat konsultasi berhasil disimpan.</div>";
  } else {
    echo "<div class='alert alert-danger'>Gagal menyimpan riwayat konsultasi.</div>";
  }
}

echo '<a href="view_konsultasi.php" class="btn btn-secondary mt-3">
        <i class="fas fa-arrow-left"></i> Kembali
      </a>';
echo '</div>
      </div>
    </div>';
