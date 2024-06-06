<?php
require 'db.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "UPDATE users SET status = 1 WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    echo "User approved successfully";
} else {
    echo "Invalid request";
}
?>
