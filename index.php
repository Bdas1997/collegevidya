<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>College Vidya</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            padding: 1em;
            border: 1px solid #ccc;
            border-radius: 1em;
        }

        input {
            width: 100%;
            padding: 0.5em;
            margin-bottom: 1em;
        }

        button {
            width: 100%;
            padding: 0.7em;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 1em;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            padding: 0.5em;
            margin-bottom: 1em;
            color: #dc3545;
            border: 1px solid #dc3545;
            border-radius: 1em;
        }

        .new-account {
            text-align: center;
            margin-top: 1em;
        }

        .new-account a {
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<div class="message">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    }
    ?>
    <h2>Login</h2>
    <form id="loginForm" action="fetch.php" method="POST">
        <input type="text" id="username" name="username" placeholder="Username">
        <input type="password" id="password" name="password" placeholder="Password">
        <button type="submit" name="submit">Login</button>
    </form>
    <div class="new-account">
        <a href="account_signup.php">Create New Account</a>
    </div>
</body>
</html>
