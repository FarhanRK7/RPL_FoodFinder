<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "rpl";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if (mysqli_connect_errno()) {
    echo "Koneksi gagal: " . mysqli_connect_error();
    die("Eror!");
}
?>