<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum, redirect ke halaman login
    header("Location: login.php");
    exit();
}

// Ambil username dari sesi
$id = $_SESSION['id'];
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
    <link rel="stylesheet" href="Tampilan_1.css">

    <!-- Icons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
</head>
<body>

    <div class="sidebar1"></div>
    <div class="sidebar2"></div>

    <div class="sesion_1">
        <div class="judul">
            <div class="1">
                <span>FOOD</span>
            </div>
            <div class="2">
                <span>FINDER</span>
            </div>
        </div>
        <div class="tombol">
            <div class="button1">
                <a href="Landing_page2.php">
                    <span class="name">HOME</span>
                </a>
            </div>
            <div class="button3">
                <a href="bahan.php">
                    <span class="name">BAHAN</span>
                </a>
            </div>
            <?php
include 'db.php'; // Pastikan Anda memasukkan file koneksi database di sini

$id = $_SESSION['id']; // Mengambil user_id dari sesi

// Memeriksa apakah ada parameter judul di URL
if(isset($_GET['judul'])) {
    $judul_resep = $_GET['judul'];

    // Ambil id_resep dari tabel resep berdasarkan judul yang diberikan
    $get_resep_id_sql = "SELECT id_resep FROM resep WHERE judul = ?";
    $get_resep_id_stmt = $db->prepare($get_resep_id_sql);
    $get_resep_id_stmt->bind_param("s", $judul_resep);
    $get_resep_id_stmt->execute();
    $get_resep_id_result = $get_resep_id_stmt->get_result();

    if ($get_resep_id_result->num_rows > 0) {
        $row = $get_resep_id_result->fetch_assoc();
        $resep_id = $row['id_resep'];
?>
        <form action="Favorite.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $id; ?>">
            <input type="hidden" name="resep_id" value="<?php echo $resep_id; ?>">
            <button type="submit" class="button2">
                <i class="fa-solid fa-heart"></i>
            </button>
        </form>
<?php
    } else {
        echo "Resep tidak ditemukan.";
    }

    $get_resep_id_stmt->close();
}
?>


        </div>
        <div class="garis"></div>
        <?php
        include 'db.php';
        if (isset($_GET['judul'])) {
            $judul = $db->real_escape_string($_GET['judul']);
            $sql = "SELECT * FROM resep WHERE judul = '$judul'";
            $result = $db->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();

                echo '<div class="Kotak">';
                echo '<img src="' . htmlspecialchars($row['gambar']) . '" alt="' . htmlspecialchars($row['judul']) . '" class="gambar">';
                echo '</div>';

                echo '<div class="kotak2">
                        <div class="subjudul_awal">
                            <div class="satu">
                                <span><h2 class="Judulmakan">' . htmlspecialchars($row['judul']) . '</h2></span>
                            </div>
                        </div>
                    </div>';
            } else {
                echo '<p>Tidak ada gambar yang ditemukan.</p>';
            }

            $db->close();
        } else {
            echo '<p>Judul tidak ditemukan.</p>';
        }
        ?>

                </div>
            </div>
        </div>
    </div>

    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br>

    <div class="sesion_2">
        <div class="kotak3">
            <div class="subjudul1">
                <div class="atas">
                    <span>BAHAN-BAHAN</span>
                </div>
                <div class="satu">
                    <span>
                    <?php
                    include 'db.php';
                    if (isset($_GET['judul'])) {
                        $judul = $db->real_escape_string($_GET['judul']);

                        $sql = "SELECT * FROM resep WHERE judul = '$judul'";
                        $result = $db->query($sql);

                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                        
                            // Memisahkan bahan menjadi array dengan delimiter ';'
                            $bahan = explode(';', $row['bahan']);
                            
                            // Menampilkan setiap bahan
                            foreach ($bahan as $item) {
                                echo $item . '<br>'; // Menampilkan setiap bahan dengan baris baru
                            }
                        }
                        

                        } else {
                            echo '<h2>Materi tidak ditemukan</h2>';
                        }
                    $db->close(); // Menutup koneksi
                    ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="kotak4">
            <div class="subjudul2">
                <div class="atas">
                    <span>INTRUKSI</span>
                </div>
                <div class="satu">
                    <span>
                    <?php
                    include 'db.php';
                    if (isset($_GET['judul'])) {
                        $judul = $db->real_escape_string($_GET['judul']);

                        $sql = "SELECT * FROM resep WHERE judul = '$judul'";
                        $result = $db->query($sql);

                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                        
                            // Memisahkan bahan menjadi array dengan delimiter ';'
                            $intruksi = explode(';', $row['instruksi']);
                            
                            // Menampilkan setiap bahan
                            foreach ($intruksi as $item) {
                                echo $item . '<br>'; // Menampilkan setiap bahan dengan baris baru
                            }
                        }
                        

                        } else {
                            echo '<h2>Materi tidak ditemukan</h2>';
                        }
                    $db->close(); // Menutup koneksi
                    ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br>

    <div class="sesion_3"></div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6PZmfzTQQgxC7AL7KnMhP4YYFRYQR+jcDo6K6YSOYxFRgCCTnRaPq8u/2r9" crossorigin="anonymous"></script>
</body>
</html>
