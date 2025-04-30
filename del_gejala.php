<?php

$idgejala = $_GET['id_gejala'];

$sql = "DELETE FROM gejala WHERE id_gejala='$idgejala'";
if ($conn->query($sql) === TRUE) {
  header("Location:?page=gejala");
}
$conn->close();
