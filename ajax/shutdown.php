<?php

$pass = $_POST["password"];


exec('sudo -u root -S init 0 < '.$pass);
?>
