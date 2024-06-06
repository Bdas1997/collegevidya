<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Include database connection
require 'db.php';

// Fetch user's name and account balance
$user_query = $pdo->prepare("SELECT user_id, balance FROM accounts WHERE user_id = :user_id");
$user_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$user_query->execute();
$user = $user_query->fetch(PDO::FETCH_ASSOC);

$user_name = $_SESSION['user_name'];
$account_balance = $user['balance'];
?>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
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

a {
    color: #007bff;
    text-decoration: none;
}



</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Vidya</title>
</head>
<body>
    <div>
        <h1>Welcome, <?php echo $user_name; ?></h1>
        <p>Account Balance: $<?php echo $account_balance; ?></p>
        <a href="logout.php">Logout</a>
    </div>

    <div>
        <h2>Transaction</h2>
        <?php
    if (isset($_SESSION['message'])) {
        echo '<div class="message">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']); 
    }
    ?>
        <form action="process_transaction.php" method="POST">
            <label for="transaction-type">Transaction Type:</label>
            <select name="transaction-type" id="transaction-type">
                <option value="1">Credit</option>
                <option value="2">Debit</option>
            </select>
            <br>
            <label for="cheque-number">Cheque Number:</label>
            <input type="text" name="cheque_number" id="cheque-number">
            <br>
            <label for="cheque-number">Amount:</label>
            <input type="text" name="amount" id="amount">
            <br>
            <input type="submit" value="Submit" >
        </form>
    </div>
</body>
</html>
