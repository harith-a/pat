<?php

$pass = $_POST["password"];

echo $pass;
exec('sudo -u root -S init 0 < '.$pass);
?>
