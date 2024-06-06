<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Vidya</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
   
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="dashboard.php">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link active" id="approve-account-tab" data-toggle="tab" href="#approve-account" role="tab" aria-controls="approve-account" aria-selected="true">Approve Account Creation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="approve-cheques.php">Approve Cheques</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view-reports.php">View Reports of All Transactions</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link btn btn-danger text-white" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="tab-content mt-3" id="myTabContent">
        <div class="tab-pane fade show active" id="approve-account" role="tabpanel" aria-labelledby="approve-account-tab">
            <table id="usersTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Aadhar Number</th>    
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>


</div>
<script>
$(document).ready(function() {
    var table = $('#usersTable').DataTable({
        "ajax": "fetch_users.php",
        "columns": [
            { "data": "name" },
            { "data": "email" },
            { "data": "mobile" },
            { "data": "aadhar" },
            { "data": "actions" }
        ]
    });

    $('#usersTable').on('click', '.approve-btn', function() {
        var userId = $(this).data('id');
        $.ajax({
            url: 'approve_user.php',
            type: 'POST',
            data: { id: userId },
            success: function(response) {
                table.ajax.reload();
                alert(response);
            }
        });
    });

    $('#usersTable').on('click', '.reject-btn', function() {
        var userId = $(this).data('id');
        $.ajax({
            url: 'reject_user.php',
            type: 'POST',
            data: { id: userId },
            success: function(response) {
                table.ajax.reload();
                alert(response);
            }
        });
    });
});


</script>
</body>
</html>
