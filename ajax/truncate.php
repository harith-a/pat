<?php

include('db.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $sql = "TRUNCATE `pti_ahli`";
    if ($conn->query($sql) === true) {
        echo "Database Emptied";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $sql = "TRUNCATE `pti_petugas`";
    if ($conn->query($sql) === true) {
        echo "Database Emptied";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();

?>