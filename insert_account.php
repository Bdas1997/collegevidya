<?php
require 'db.php';

//print_r($_POST);exit;
function generateToken($length = 32) {
    return bin2hex(random_bytes($length));
}

$token = generateToken();

function generateOTP($length = 12) {
    $account_no = '';
    for ($i = 0; $i < $length; $i++) {
        $account_no .= rand(0, 9); 
    }
    return $account_no;
}

$account_no = generateOTP();


 
    $stmt = $pdo->prepare("
        INSERT INTO users (account_no,username, password, role, name, email, mobile, account_type, aadhar, token, status) 
        VALUES (:account_no,:username, :password, :role, :name, :email, :mobile, :account_type, :aadhar, :token, :status)
    ");

    $stmt->bindParam(':account_no', $account_no);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mobile', $mobile);
    $stmt->bindParam(':account_type', $account_type);
    $stmt->bindParam(':aadhar', $aadhar);
    $stmt->bindParam(':token', $token);
    $stmt->bindParam(':status', $status);

    $account_no = $account_no;
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 
    $role = 2;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $account_type = $_POST['account_type'];
    $aadhar = $_POST['aadhar'];
    $token = $token;
    $status = 2;

    $stmt->execute();
    $user_id = $pdo->lastInsertId();


    $stmt = $pdo->prepare("
        INSERT INTO accounts (user_id,balance, created_at) 
        VALUES (:user_id,:balance, :created_at)
    ");

    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':balance', $balance);
    $stmt->bindParam(':created_at', $created_at);

    $user_id = $user_id;
    $balance = $_POST['amount'];
    $created_at = date('Y-m-d H:i:s');

    $stmt->execute();
    


    $_SESSION['message'] = 'Account Created successful';
    header('Location: index.php');
    exit;



?>

