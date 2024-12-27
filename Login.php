<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="Login.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
</head>
<body>

<div class="sidebar1">
    </div>
<div class="sidebar2">
</div>

<div class="Ellipse_1">
</div>

    <h2>Welcome</h2>
    <p>Tolong masukkan informasi anda.</p>

    <form action="login.php" method="POST">
        <div class="user">
            <input type="text" name="username" id="username" required>
            <label for="username">Username</label>
        </div>
        <div class="pass">
            <input type="password" name="password" id="password" required>
            <label for="password">Password</label>
        </div>
        <div class="b0">
            <button type="submit" name="login">Login</button>
        </div>   
    </form>

    <div class="text">
        <span>Belum punya akun ? </span><br>
        <span>tekan tombol dibawah untuk membuat akun</span>
    </div>
    <div class="b1">
        <a href="bikin.php">
            <div class="b2">
                <span>Create</span>
            </div>
        </a>
    </div>
    
</body>
</html>

<?php
session_start();
require 'koneksi.php'; // Atau file konfigurasi Anda untuk koneksi database

// Memproses form login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Contoh query untuk mengambil data user dari database menggunakan PDO
    $sql = "SELECT id, username, password FROM user WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->execute([':username' => $username]);

    // Memeriksa apakah username ditemukan
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $storedPassword = $row['password']; // Password yang disimpan di database

        // Verifikasi password (tanpa hashing)
        if ($password === $storedPassword) {
            // Password benar, simpan username di sesi
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            
            
            // Redirect ke halaman home
            header("Location: Landing_page2.php");
            exit();
        } else {
            echo '<script>
            alert("Password salah.");
            </script>
            ';
        }
    } else {
        echo '<script>
        alert("User Tidak Ditemukan.");
        </script>
        ';
    }
}
?>
