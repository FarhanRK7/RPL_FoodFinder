<?php
session_start(); // Memulai sesi


// Menghancurkan sesi
session_destroy();

// Redirect ke halaman login atau halaman lainnya
header("Location: login.php");
exit;
?>