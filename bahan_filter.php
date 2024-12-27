<?php
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
    <link rel="stylesheet" href="bahan_filter.css">

    <!-- Icons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
    
  </head>
  <body>

    <div class="sidebar1">
    </div>
    <div class="sidebar2">
    </div>

    <div class="judul">
        <div class="1">
            <Span>FOOD</Span>
        </div>
        <div class="2">
            <Span>FINDER</Span>
        </div>
    </div>

    <div class="button1">
          <a href="bahan.php">
            <span class="name">SWITCH</span>
          </a>
    </div>

    <div class="button2">
          <a href="Landing_page2.php">
            <span class="name">HOME</span>
          </a>
    </div>

    <div class="button3">
          <a href="bahan.php">
            <span class="name">BAHAN </span>
          </a>
    </div>

    <div class="button4">
          <a href="favorite.php">
            <span class="name">FAVORITE</span>
          </a>
    </div>

    <div class="garis">
    </div>

<div class="kotak2">
    <div class="tampil">
        <div class="tampil-container">
            <div class="tampil-item">
                <div class="satu">
                    <div class="subjudul">
                        <span>Bahan-Bahan</span>
                    </div>
                </div>
                <div class="filter-bahan" id="bahan-list">
                    <?php
                    // Daftar bahan dasar
                    $bahan_dasar = [

                        // bahan dasar

                        "Garam", "Gula", "Minyak", "Susu", "Telur", "Tepung", "Baking Powder", "Soda Kue", "Ragi", "Ragi Instant",
                        "Saus Tomat", "Kecap", "Kecap Manis", "Kecap Asin", "Saus Barbecue", "Mayones", "Saos Sambal", "Santan", "Kuning Telur",
                        "Bawang Putih", "Bawang Bombay", "Jahe", "Serai", "Santan Kental", "Kunyit", "Lengkuas", "Lada Hitam", "Merica", "Gula Jawa",
                        "Sereh", "Daun Pandan", "Daun Jeruk", "Kemiri", "Ketumbar", "Bawang Merah", "Cabe Merah", "Cabe Rawit", "Daun Bawang", "Kencur",
                        "Kunyit", "Daun Salam", "Daun Kemangi", "Daun Sereh", "Daun Bayam", "Daun Ketumbar", "Serai", "Daun Jeruk", "Daun Pandan",
                        "Daun Sereh", "Daun Salam", "Lemongrass",

                        // bahan pokok tambahan
                        "Beras", "Jagung", "Ketela", "Ubi Jalar", "Kentang", "Gandum", "Kacang Hijau", "Kacang Tanah", "Kacang Merah", "Kacang Kedelai",
                        "Kacang Kapri", "Kacang Tunggak", "Kacang Mete", "Kacang Mede", "Kacang Buncis", 
                    ];

                    // Loop untuk menampilkan checkbox untuk setiap bahan dasar
                    foreach ($bahan_dasar as $item) {
                        echo '<label><input type="checkbox" class="checkbox-bahan" value="' . $item . '">' . $item . '</label>';
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>

    <div class="garis_2">
    </div>

    <!-- Tombol Kirim -->
    <div class="button-kirim">
        <button type="button" onclick="submitBahan()">KIRIM</button>
    </div>
</div>

<script>

    function submitBahan() {
        var checkboxes = document.querySelectorAll('.checkbox-bahan:checked');
        var values = Array.from(checkboxes).map(function(checkbox) {
            return checkbox.value;
        });

        // Kirim nilai bahan yang dipilih ke halaman lain, misalnya bahan.php
        window.location.href = 'bahan_after2.php?selected=' + values.join(',');
    }

</script>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>