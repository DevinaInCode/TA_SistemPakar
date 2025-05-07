<?php

$id = $_GET['id'];

$sql = "DELETE FROM penyakit WHERE id ='$id'";
if ($conn->query($sql) === TRUE) {
  header("Location:?page=penyakit");
}
$conn->close();
