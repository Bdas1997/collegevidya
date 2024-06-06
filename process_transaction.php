<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_type = $_POST['transaction-type'];
    $cheque_number = $_POST['cheque_number'];
    $amount = $_POST['amount'];
   
    $pdo->exec("SET time_zone = '+05:30'");

    $insert_query = $pdo->prepare("INSERT INTO transactions (account_id, transaction_type, amount, cheque_number, status, created_at) VALUES (:account_id, :transaction_type, :amount, :cheque_number, 1, NOW())");
    $insert_query->bindParam(':account_id', $user_id, PDO::PARAM_INT);
    $insert_query->bindParam(':transaction_type', $transaction_type, PDO::PARAM_STR);
    $insert_query->bindParam(':amount', $amount, PDO::PARAM_INT);
    $insert_query->bindParam(':cheque_number', $cheque_number, PDO::PARAM_STR);
    $insert_query->execute();

    $_SESSION['message'] = 'Successful Submitted Send for Approval';
    header('Location: transaction_page.php');
    exit();
}
?>
