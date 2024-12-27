<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['id'];
    $resep_id = $_POST['resep_id'];

    $sql = "DELETE FROM user_favorites WHERE user_id = ? AND resep_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ii", $user_id, $resep_id);
    
    if ($stmt->execute()) {
        header("Location: Favorite.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $db->close();
}
?>
