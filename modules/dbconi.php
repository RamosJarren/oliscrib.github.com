<?php
$username = "root";
$password = "";
$server   = "localhost:3306";
$dbasename = "database1";

$dbc = mysqli_connect($server, $username, $password);
mysqli_select_db($dbc, $dbasename);
?>