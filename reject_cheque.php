<?php
require 'db.php';

if (isset($_POST['id'])) 
{
    //print_r($_POST);exit;
    $id = $_POST['id'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $cheque = $_POST['cheque'];
    $update_query = $pdo->prepare("UPDATE transactions SET status = 3 WHERE account_id = :id AND transaction_type = :type AND cheque_number = :cheque");
    $update_query->bindParam(':id', $id, PDO::PARAM_INT);
    $update_query->bindParam(':type', $type, PDO::PARAM_INT);
    $update_query->bindParam(':cheque', $cheque, PDO::PARAM_INT);
    $update_query->execute();
    

    echo "Cheque Rejected successfully";
} 
else 
{
    echo "Invalid request";
}
?>
