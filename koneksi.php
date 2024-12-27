<?php

$db_host = "localhost";
$db_user = "root"; 
$db_pass = ""; 
$db_name = "rpl";

$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

?>