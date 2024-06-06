<?php
session_start(); 
require 'db.php'; 

function generateToken($length = 32) {
    return bin2hex(random_bytes($length));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND status = 1");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        
        $token = generateToken();

        $stmt = $pdo->prepare("UPDATE users SET token = ? WHERE id = ?");
        $stmt->execute([$token, $user['id']]);

        $_SESSION['message'] = 'Login successful';
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_id'] = $user['id'];
        if($user['role'] == 'admin'){
            header('Location: dashboard.php');
            exit();
        }else{
            header('Location: transaction_page.php');
            exit();
        }
        
    } else {
      
        $_SESSION['message'] = 'Invalid credentials';
        header('Location: login.php');
        exit();
    }
}
?>
