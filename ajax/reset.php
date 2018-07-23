<?php

include('db.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// $sql = "UPDATE " . $tablename . " SET Registered=0";
$sql = "UPDATE `pti_ahli` SET Registered=0";


if ($conn->query($sql) === TRUE) {
    echo "Berjaya Reset Pendaftaran";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();



?>