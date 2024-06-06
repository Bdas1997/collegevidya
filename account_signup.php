<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Vidya</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Create Account</h2>
        <form id="accountForm" action="insert_account.php" method="POST" class="mt-3">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile No:</label>
                <input type="number" id="mobile" name="mobile" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="account_type">Account Type:</label>
                <select id="account_type" name="account_type" class="form-control" required>
                    <option value="1">Saving</option>
                    <option value="2">Current</option>
                </select>
            </div>
            <div class="form-group">
                <label for="aadhar">Aadhar No:</label>
                <input type="number" id="aadhar" name="aadhar" class="form-control" maxlength="12" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Account</button>
        </form>
        <div class="mt-3">
            <a href="index.php">Already have an account? Login</a>
        </div>
    </div>
</body>
</html>
