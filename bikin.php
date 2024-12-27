<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("koneksi.php");

if (isset($_POST['register'])) {
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING); // Password mentah

    if ($nama && $username && $password) {
        $sql = "INSERT INTO user (nama, username, password) VALUES (:nama, :username, :password)";
        $stmt = $db->prepare($sql);

        $params = array(
            ":nama" => $nama,
            ":username" => $username,
            ":password" => $password // Simpan password mentah (tidak aman)
        );

        $saved = $stmt->execute($params);

        if ($saved) {
            header("Location: Login.php");
            exit();
        } else {
            echo "<p>Error: Could not save the data to the database.</p>";
            echo "<p>" . implode(", ", $stmt->errorInfo()) . "</p>";
        }
    } else {
        echo "<p>Invalid input data.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembuatan Akun</title>
    <link rel="stylesheet" href="bikin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
</head>
<body>

<div class="sidebar1"></div>
<div class="sidebar2"></div>

<div class="container">
    <h1>Pembuatan Akun</h1>
    <div class="login-box">
        <h2>Selamat Datang</h2>
        <p>Tolong masukkan informasi anda.</p>
        <form id="register-form" method="POST" action="">
            <div class="input-box">
                <input type="text" name="nama" id="nama" required>
                <label for="nama">Nama</label>
            </div>
            <div class="input-box">
                <input type="text" name="username" id="username" required>
                <label for="username">Username</label>
            </div>
            <div class="input-box">
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
            </div>
            <button type="submit" name="register">Create</button>
        </form>
    </div>
</div>

</body>
</html>
