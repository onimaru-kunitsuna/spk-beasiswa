<?php

$nisn=$_GET['nisn'];

$sql = "DELETE FROM siswa WHERE nisn='$nisn'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=siswa");
}
$conn->close();
?>