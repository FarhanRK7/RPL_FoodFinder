<?php
include 'db.php';
// Function to sanitize user input
function sanitizeInput($data) {
  return htmlspecialchars(trim($data));
}

if (isset($_GET['selected']) || isset($_GET['query'])) {
  $searchTerms = [];
  $params = [];
  $types = '';
  $fieldTypes = '';

  // Process selected ingredients
  if (isset($_GET['selected'])) {
    $selected = sanitizeInput($_GET['selected']);
    $selectedArray = explode(',', $selected);
    foreach ($selectedArray as $item) {
      $searchTerms[] = 'bahan LIKE ?';
      $params[] = '%' . $item . '%';
      $types .= 's';
    }
  }

  // Process query keywords
  if (isset($_GET['query'])) {
    $query = sanitizeInput($_GET['query']);
    $queryArray = explode(',', $query); // Split by space to allow phrases

    $fieldConditions = []; // Store conditions for each field
    $fieldTypes = ''; // Track types for each field parameters

    foreach ($queryArray as $item) {
      $fieldConditions[] = "(judul LIKE ? OR bahan LIKE ?)";
      $params[] = '%' . $item . '%';
      $params[] = '%' . $item . '%';
      $fieldTypes .= 'ss';
    }

    // Combine field conditions based on boolean operators (can be extended)
    $combinedConditions = implode(' AND ', $fieldConditions);
  }

  // Build SQL query
  $sql = "SELECT * FROM resep";
  if (!empty($searchTerms) && !empty($combinedConditions)) {
    $sql .= " WHERE " . implode(' OR ', $searchTerms) . " AND " . $combinedConditions;
  } else if (!empty($searchTerms)) {
    $sql .= " WHERE " . implode(' OR ', $searchTerms);
  } else if (!empty($combinedConditions)) {
    $sql .= " WHERE " . $combinedConditions;
  }

  $stmt = $db->prepare($sql);
  if ($stmt) {
    $stmt->bind_param($types . $fieldTypes, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
      }
    }
    $stmt->close();
  } else {
    echo "Error in SQL query preparation: " . $db->error;
  }
}
?>

<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="bahan_after_1.css">

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
          <a href="bahan_filter.php">
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
          <a href="Favorite.php">
            <span class="name">FAVORITE</span>
          </a>
    </div>

    <div class="garis">
    </div>

    <div class="garis">
    </div>

    <div class="kotak2">
        <div class="tampil">
            <div class="tampil-container">
                <?php
                // Include file koneksi ke database
                include 'db.php';
                // Periksa apakah ada hasil pencarian yang diterima
                if (!empty($searchResults)) {
                    foreach ($searchResults as $result) {
                        // Tampilkan hasil pencarian dalam bentuk card
                        ?>
                        <div class="tampil-item">
                            <div class="card">
                                <img src="<?php echo $result['gambar']; ?>" class="card-img-top" alt="<?php echo $result['judul']; ?>">
                                <div class="card-body">
                                    <a href="TampilanResep.php?judul=<?php echo urlencode($result['judul']); ?>">
                                        <h5 class="card-title"><?php echo $result['judul']; ?></h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    // Tampilkan pesan jika tidak ada hasil pencarian
                    echo '<p>Tidak ada hasil pencarian.</p>';
                }
                ?>   
            </div>
        </div>
    </div>




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

<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="bahan_after_1.css">

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
          <a href="bahan_filter.php">
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
          <a href="Favorite.php">
            <span class="name">FAVORITE</span>
          </a>
    </div>

    <div class="garis">
    </div>

    <div class="garis">
    </div>

    <div class="kotak2">
        <div class="tampil">
            <div class="tampil-container">
                <?php
                // Include file koneksi ke database
                include 'db.php';
                // Periksa apakah ada hasil pencarian yang diterima
                if (!empty($searchResults)) {
                    foreach ($searchResults as $result) {
                        // Tampilkan hasil pencarian dalam bentuk card
                        ?>
                        <div class="tampil-item">
                            <div class="card">
                                <img src="<?php echo $result['gambar']; ?>" class="card-img-top" alt="<?php echo $result['judul']; ?>">
                                <div class="card-body">
                                    <a href="TampilanResep.php?judul=<?php echo urlencode($result['judul']); ?>">
                                        <h5 class="card-title"><?php echo $result['judul']; ?></h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    // Tampilkan pesan jika tidak ada hasil pencarian
                    echo '<p>Tidak ada hasil pencarian.</p>';
                }
                ?>   
            </div>
        </div>
    </div>




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