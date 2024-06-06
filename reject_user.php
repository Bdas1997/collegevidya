<?php
require 'db.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "UPDATE users SET status = 3 WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    echo "User rejected successfully";
} else {
    echo "Invalid request";
}
?>
