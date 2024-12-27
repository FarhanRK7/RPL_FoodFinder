<?php

include "db.php";

session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum, redirect ke halaman login
    header("Location: login.php");
    exit();
}

// Ambil username dari sesi
$username = $_SESSION['username'];
?>

<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Landing_page_1.css">

    <!-- Icons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
    
  </head>
  <body>

<nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-body-tertiary nav_bc">
  <div class="container-fluid">
    <div class="collapse navbar-collapse justify-content-end" >
      <ul class="navbar-nav">
        <li class="nav-item">
            <div class="profile">
                <i class="fa-solid fa-user"></i>
                <span class="name"><?php echo htmlspecialchars($username); ?></span>
            </div>
        </li>      
        <li class="nav-item">
            <div class="button1">
                <a href="bahan.php">
                    <span class="name">BAHAN</span>
                </a>
            </div>
        </li>
        <li class="nav-item">
                <div class="button2">
                    <a href="Favorite.php">
                        <span class="name">FAVORITE</span>
                    </a>
                </div>
        </li>
        <li class="nav-item">
                <div class="button3">
                    <a href="logout.php">
                        <span class="name">LOGOUT</span>
                    </a>
                </div>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="tampilan">
    <div class="tampilan_img">
        <div class="nav_bc">
        </div>
    </div>
    <div class="tulisan">
        <div class="judul">
                    <div class="1">
                        <Span>FOOD</Span>
                    </div>
                    <div class="2">
                        <Span>FINDER</Span>
                    </div>
            </div>
        <div class="subjudul">
                    <div class="satu">
                        <Span>BUATLAH PENGALAMAN</Span>
                    </div>
                    <div class="dua">
                        <span>MEMASAKMU MENJADI LEBIH MUDAH</Span>
                    </div> 
        </div>
        <div class="button_Home">
                    <a href="bahan.php">
                        <span class="name">RACIK MASAKANMMU</span>
                    </a>
        </div>
        <div class="logo">
        <a href="https://www.instagram.com">
            <i class="fa-brands fa-instagram"></i>
        </a>
        <a href="https://x.com">
            <i class="fa-brands fa-facebook"></i>     
        </a>
        <a href="https://www.youtube.com">
            <i class="fa-brands fa-youtube"></i>    
        </a>     
        <a href="https://www.facebook.com">
            <i class="fa-brands fa-twitter"></i>  
        </a>      
        </div>

    </div>
</div>

<br><br><br><br><br><br>

<div class="sesion_1">
    <div class="container text-center "> 
            <div class="row"> 
                <div class="col">
                    <div class="gambar">
                    </div> 
                </div> 
                <div class="col float-end text-start justify-content"> 
                    <div class="satu">
                        <Span>FOOD FINDER</Span>
                    </div>
                    <div class="dua">
                        <span>Food Finder merupakan perangkat lunak berbasis WEB yang menyediakan informasi mengenai resep-resep yang diperlukan untuk membuat suatu masakan. Dengan dibuatnya FoodFinder diharapkan dapat memudahkan para pengguna yang seringkali kebingungan dalam menentukan makanan apa yang dibuat dari bahan-bahan yang ada. Pengguna dapat memasukan data-data berupa bahan-bahan yang dimiliki lalu aplikasi ini akan menentukan resep-resep yang memungkinkan dibuat dari bahan-bahan yang ada.  </span>
                    </div>
                </div>
            </div> 
    </div>
</div>

<br><br><br><br><br><br>

<div class="sesion_2">
    <div class="judul">
        <div class="1">
            <Span>MENU FAVORITE</Span>
        </div>
    </div>
    <div class="kotak">
        <div class="atas">
            <div class="kotak_1">
            <!-- <img src="assets/img/nasi goreng.jpg"> -->
            </div>
            <div class="kotak_2"> 
            <!-- <img src="assets/img/nasi kuning.jpg">   -->
            </div>
            <div class="kotak_3">
            <!-- <img src="assets/img/nasi uduk.jpg"> -->
            </div>
         </div>
         <div class="bawah">
         <?php


$sql = "SELECT * FROM resep";
$result = $db->query($sql);

if ($result && $result->num_rows > 0) {
    $count = 0;  // Inisialisasi counter
    while ($row = $result->fetch_assoc()) {
        echo '
        <div class="kotak_4">
            <a href="tampilanResep.php?judul=' . urlencode($row['judul']) . '"><span>' . $row['judul'] . '</span></a>
            <div class="flex-container_satu">
                <i class="fa-regular fa-clock"></i>
                <span>60 M</span>
            </div>
            <div class="flex-container">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>
        </div>';
        
        $count++;  // Increment counter
        if ($count >= 3) {
            break;  // Hentikan loop setelah 3 item
        }
    }
} else {
    echo '<p>Tidak ada materi yang tersedia.</p>';
}

mysqli_free_result($result);
mysqli_close($db);
?>

    </div>
</div>

<br><br><br><br><br><br><br><br>

<div class="sesion_2_1">
    <div class="kotak">
        <div class="judul">
                <Span>The Recipes</Span>
        </div>
        <div class="subjudul">
                <Span>Resep yang terdapat pada Website ini merupakan sebuah resep yang diambil pada kumpulan data,</Span>
                <Span>Pentunjuk dan arahan yang diberikan mudah untuk di ikuti dan mudah dipahami bagi beberapa orang yang berusaha untuk mememulai pengalaman memasak.</Span>
                <Span>kami menyediakan beberapa fungsi yang membuat agar pencaharian resep menjadi lebih mudah dan dapat menyesuaikan dengan bahan yang dimiliki</Span>
        </div>
        <div class="gambar_1"></div>
    </div>
</div>

<br><br><br><br><br><br><br><br>

<div class="sesion_3">
    <!-- Footer -->
    <footer class="footer_awal text-center text-lg-start bg-body-tertiary text-muted">
        <!-- Section: Social media -->
        <section class="footer_link d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
            <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div> 
            <a href="https://www.instagram.com" class="me-4 text-reset">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://x.com" class="me-4 text-reset">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.youtube.com" class="me-4 text-reset">
                <i class="fa-brands fa-youtube"></i>
            </a>
            <a href="https://www.instagram.com" class="me-4 text-reset">
                <i class="fab fa-instagram"></i>
            </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="footer_isi">
        <div class="container text-center text-md-start mt-2">
        <!-- Grid row -->
        <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
                <i class="fas fa-gem me-3"></i>FOOD FINDER 
            </h6>
            <p style="text-align: justify;">
                Merupakan Sebuah Website yang bertujuan untuk membuat pengalaman memasak menjadi lebih mudah
                dan menyenangkan, dengan banyaknya resep yang tersedia.
            </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
            <p><i class="fas fa-home me-3"></i> Bandung, Indonesia</p>
            <p>
                <i class="fas fa-envelope me-3"></i>
                email@upi.edu
            </p>
            <p><i class="fas fa-phone me-3"></i> + 62 234 567 88</p>
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="footer_last p-4">
    </div>
    <!-- Copyright -->
    </footer>
    <!-- Footer -->
</div>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>