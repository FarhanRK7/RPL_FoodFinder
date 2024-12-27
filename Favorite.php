<?php
include 'db.php';
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum, redirect ke halaman login
    header("Location: login.php");
    exit();
}

// Ambil user_id dari sesi
$id = $_SESSION['id'];
$username = $_SESSION['username'];

?>

<?php
include 'db.php'; // Pastikan Anda memasukkan file koneksi database di sini

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil dan memvalidasi input
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
    $resep_id = isset($_POST['resep_id']) ? $_POST['resep_id'] : null;

    // Pastikan user_id dan resep_id valid
    if ($user_id && $resep_id) {
        // Cek keberadaan resep_id dalam tabel resep
        $check_recipe_sql = "SELECT * FROM resep WHERE id_resep = ?";
        $check_recipe_stmt = $db->prepare($check_recipe_sql);
        $check_recipe_stmt->bind_param("i", $resep_id);
        $check_recipe_stmt->execute();
        $recipe_result = $check_recipe_stmt->get_result();

        if ($recipe_result->num_rows == 0) {
            echo "Resep tidak ditemukan.";
        } else {
            // Cek apakah sudah ada dalam favorit
            $check_sql = "SELECT * FROM user_favorites WHERE user_id = ? AND resep_id = ?";
            $check_stmt = $db->prepare($check_sql);
            $check_stmt->bind_param("ii", $user_id, $resep_id);
            $check_stmt->execute();
            $result = $check_stmt->get_result();

            if ($result->num_rows == 0) {
                // Tambahkan ke tabel favorite jika belum ada
                $insert_sql = "INSERT INTO user_favorites (user_id, resep_id) VALUES (?, ?)";
                $insert_stmt = $db->prepare($insert_sql);
                $insert_stmt->bind_param("ii", $user_id, $resep_id);

                if ($insert_stmt->execute()) {
                    echo "<script>alert('Resep ini berhasil ditambahkan ke favorit anda!');</script>";
                } else {
                    echo "Error: " . $insert_stmt->error;
                }

                $insert_stmt->close();
            } else {
                echo "<script>alert('Resep ini sudah ada di daftar favorit anda!');</script>";
            }

            $check_stmt->close();
        }

        $check_recipe_stmt->close();
    } else {
        echo "Invalid user or recipe ID.";
    }
}

$db->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Favorite.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="sidebar1"></div>
    <div class="sidebar2"></div>

    <div class="judul">
        <div class="1">
            <Span>FAVORITE</Span>
        </div>
    </div>

    <div class="Ellipse_1"></div>
    <div class="Ellipse_2"></div>

    <div class="button1">
        <a href="Landing_page2.php">
            <span class="name">HOME</span>
        </a>
    </div>

    <div class="button2">
        <a href="bahan.php">
            <span class="name">BAHAN</span>
        </a>
    </div>

    <div class="garis"></div>
    <div class="kotak2">
        <div class="tampil">
            <div class="tampil-container">
                <?php
                include 'db.php';
                
                if (!isset($_SESSION['username'])) {
                    header("Location: login.php");
                    exit();
                }

                $id = $_SESSION['id'];
                $username = $_SESSION['username'];

                function getFavorit($db, $user_id)
                {
                    $sql = "SELECT r.* FROM user_favorites uf
                            JOIN resep r ON uf.resep_id = r.id_resep
                            WHERE uf.user_id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $rows = [];
                    while ($row = $result->fetch_assoc()) {
                        $rows[] = $row;
                    }
                    $stmt->close();
                    return $rows;
                }

                $favorit = getFavorit($db, $id);
                foreach ($favorit as $item) {
                ?>
                 <div class="tampil-item">
                    <div class="card">
                        <img src="<?php echo htmlspecialchars($item['gambar']); ?>" class="card-img-top" alt="..." style="width: 100%; border-radius: 10px;">
                        <div class="card-body">
                            <div class="title-and-button">
                                <a href="TampilanResep.php?judul=<?php echo urlencode($item['judul']); ?>">
                                    <h5 class="card-title"><?php echo htmlspecialchars($item['judul']); ?></h5>
                                </a>
                                <form action="hapus_favorit.php" method="post">
                                    <input type="hidden" name="resep_id" value="<?php echo $item['id_resep']; ?>">
                                    <button type="submit" class="button_favo">
                                        <i class="fa-solid fa-heart"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                $db->close();
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
