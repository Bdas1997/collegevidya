<?php
require 'db.php';

$start_date = $_POST['start_date'] ?? null;
$end_date = $_POST['end_date'] ?? null;
$time_interval = $_POST['time_interval'] ?? null;

$query = "SELECT u.name, u.email, t.cheque_number,CASE 
WHEN t.transaction_type = 1 THEN 'Credit'
ELSE 'Debit'
END as transaction_type, t.amount FROM users u
JOIN transactions t ON t.account_id = u.id
JOIN accounts a ON a.user_id = u.id
WHERE 1=1";

if ($start_date) {
    $query .= " AND t.created_at >= :start_date";
}
if ($end_date) {
    $query .= " AND t.created_at <= :end_date";
}

$stmt = $pdo->prepare($query);

if ($start_date) {
    $stmt->bindParam(':start_date', $start_date);
}
if ($end_date) {
    $stmt->bindParam(':end_date', $end_date);
}

$stmt->execute();
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($reports);
?>
