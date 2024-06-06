<?php
require 'db.php';

if (isset($_POST['id'])) 
{
    //print_r($_POST);exit;
    $id = $_POST['id'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $cheque = $_POST['cheque'];
    $update_query = $pdo->prepare("UPDATE transactions SET status = 2 WHERE account_id = :id AND transaction_type = :type AND cheque_number = :cheque");
    $update_query->bindParam(':id', $id, PDO::PARAM_INT);
    $update_query->bindParam(':type', $type, PDO::PARAM_INT);
    $update_query->bindParam(':cheque', $cheque, PDO::PARAM_INT);
    $update_query->execute();
    

    if($type == 1){
    $update_query = $pdo->prepare("UPDATE accounts SET balance = balance + :amount WHERE user_id = :user_id");
    $update_query->bindParam(':amount', $amount, PDO::PARAM_INT);
    $update_query->bindParam(':user_id', $id, PDO::PARAM_INT);
    $update_query->execute();
    } else {
    $update_query = $pdo->prepare("UPDATE accounts SET balance = balance - :amount WHERE user_id = :user_id");
    $update_query->bindParam(':amount', $amount, PDO::PARAM_INT);
    $update_query->bindParam(':user_id', $id, PDO::PARAM_INT);
    $update_query->execute();  
    }
    echo "Cheque approved successfully";
} 
else 
{
    echo "Invalid request";
}
?>
