<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

require 'db.php';

// Fetch user account details
$user_query = $pdo->prepare("SELECT user_id, balance FROM accounts WHERE user_id = :user_id");
$user_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$user_query->execute();
$user = $user_query->fetch(PDO::FETCH_ASSOC);

$user_name = $_SESSION['user_name'];
$account_balance = $user['balance'];

// Fetch user transactions
$transactions_query = $pdo->prepare("
    SELECT 
        t.account_id, 
        t.amount, 
        t.transaction_type, 
        t.created_at 
    FROM 
        transactions t 
    WHERE 
        t.account_id = :user_id  AND t.status = 2
    ORDER BY 
        t.created_at DESC
");
$transactions_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$transactions_query->execute();
$transactions = $transactions_query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Vidya</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .navbar {
            display: flex;
            justify-content: center;
            background-color: #333;
        }

        .navbar a {
            padding: 14px 20px;
            display: block;
            color: white;
            text-align: center;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        h1, h2 {
            color: #333;
        }

        p {
            margin: 10px 0;
        }

        .message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: #dff0d8;
            color: #3c763d;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin: 5px 0 10px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .logout {
            float: right;
            margin-right: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .credit {
            color: green;
        }

        .debit {
            color: red;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>College Vidya</h1>
    </div>
    <div class="navbar">
        <a href="transaction_page.php" class="nav-link active">Dashboard</a>
        <a href="transactions.php" class="nav-link">Transactions</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <h1>Welcome, <?=$user_name?></h1>
        <p>Account Balance: $<?=$account_balance?></p>
        <h2>Your Transactions</h2>
        <table>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Amount</th>
            </tr>
            <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><?=date('Y-m-d H:i:s', strtotime($transaction['created_at']))?></td>
                <td class="<?= $transaction['transaction_type'] == 1 ? 'Credit' : 'Debit' ?>">
                    <?= $transaction['transaction_type'] == 1 ? 'Credit' : 'Debit' ?>
                </td>
                <td>
                    $<?= number_format($transaction['amount'], 2) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
