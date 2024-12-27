<?php
include 'db.php'; // Ensure this file correctly initializes the $db variable as a PDO instance

session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum, redirect ke halaman login
    header("Location: login.php");
    exit();
}

// Ambil username dari sesi
$username = $_SESSION['username'];
function getBahan($db)
{
    $sql = "SELECT * FROM resep";
    $result = $db->query($sql);
    $rows = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $rows[] = $row;
    }
    return $rows;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahan - Food Finding</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="bahan_2_1.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-1">
            <div class="sidebar1"></div>
            <div class="sidebar2"></div>
        </div>
        <div class="atas">
            <div class="atas-item">
                <div class="judul">
                    <div>
                        <span>FOOD</span>
                    </div>
                    <div>
                        <span>FINDER</span>
                    </div>
                </div>
                <div class="judul-bawah">
                    <div class="d-flex justify-content-around my-4">
                        <div class="judul-bawah-item">  
                            <div class="buttonkiri">
                                <div class="button1">
                                    <a href="bahan_filter.php">
                                        <span class="name">SWITCH</span>
                                    </a>
                                </div>
                            </div>
                            <div class="buttonkanan">
                                <div class="button2">
                                    <a href="Landing_page2.php">
                                        <span class="name">HOME</span>
                                    </a>
                                </div>
                                <div class="button3">
                                    <a href="bahan.php">
                                        <span class="name">BAHAN</span>
                                    </a>
                                </div>
                                <div class="button4">
                                    <a href="favorite.php">
                                        <span class="name">FAVORITE</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="garis mx-auto"></div>
                </div>
            </div>
            <form action="bahan_after2.php" method="GET" class="my-4">
                <div class="input input-group mb-3">
                    <input type="search" class="form-control rounded" placeholder="Search" name="query" id="search-input" aria-label="Search" aria-describedby="search-addon" autocomplete="off">
                    <button type="submit" class="btn btn-outline-primary" data-mdb-ripple-init>Search</button>
                </div>
            </form>
            <div class="garis_1 mx-auto"></div>

            <div class="kotak2">
                <div class="tampil">
                    <div class="tampil-container">
                        <?php
                        include "koneksi.php"; // Pastikan file ini menginisialisasi variabel $db dengan benar sebagai instance PDO
                        $bahan = getBahan($db); 
                        foreach ($bahan as $bahan2) {
                        ?>
                        <div class="tampil-item">
                            <div class="card">
                                <img src="<?php echo $bahan2['gambar']; ?>" class="card-img-top" alt="..." style="width: 100%; border-radius: 10px;">
                                <div class="card-body">
                                    <a href="TampilanResep.php?judul=<?php echo urlencode($bahan2['judul']); ?>">
                                    <h5 class="card-title"><?php echo $bahan2['judul']; ?></h5>
                                    </a>
                                    <p class="card-text"></p>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
