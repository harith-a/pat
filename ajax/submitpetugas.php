<?php
include('db.php');

$tablename = "pti_petugas";

$IC = $_POST["IC"];
$Register = $_POST["Register"];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE " . $tablename . " SET REGISTERED=$Register WHERE NO_KP='$IC'";

if ($conn->query($sql) === TRUE) {
    echo "Berjaya";
} else {
	echo "Gagal didaftar, sila hubungi Technical Support";
    // echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
