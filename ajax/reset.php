<?php

include('db.php');

$tablename = "pti_xahli";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE " . $tablename . " SET Registered=0";
$sql2 = "UPDATE `pti_ahli` SET Registered=0";

if ($conn->query($sql) === TRUE) {
    echo "Berjaya Reset Bukan Ahli";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
    echo "Berjaya Reset Ahli";
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}

$conn->close();



?>