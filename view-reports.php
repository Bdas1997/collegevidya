<?php
require 'db.php';

$condition = "";

if((isset($_GET['start_date']) && $_GET['start_date'] != '') && (isset($_GET['end_date']) && $_GET['end_date'] != ''))
	{
	
		
	
	    $start_date = date('Y-m-d',strtotime($_GET['start_date']));
		$end_date = date('Y-m-d',strtotime($_GET['end_date']));
		
		$condition .= "WHERE date(t.`created_at`) BETWEEN '$start_date' AND '$end_date'";
	}

    if(isset($_GET['time_interval']) && $_GET['time_interval'] != '')
{
    switch ($_GET['time_interval']) {
        case '1hr':
            $condition .= " AND t.`created_at` >= DATE_SUB(NOW(), INTERVAL 1 HOUR)";
            break;
        case '2hr':
            $condition .= " AND t.`created_at` >= DATE_SUB(NOW(), INTERVAL 2 HOUR)";
            break;
       
    }
}
 $sql = "SELECT u.name, u.email, t.cheque_number, CASE 
WHEN t.transaction_type = 1 THEN 'Credit'
ELSE 'Debit'
END as transaction_type, t.created_at as transaction_date, t.amount FROM users u
JOIN transactions t ON t.account_id = u.id
JOIN accounts a ON a.user_id = u.id $condition";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                    <a class="nav-link" href="dashboard.php">Approve Account Creation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="approve-cheques.php">Approve Cheques</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="view-reports.php">View Reports of All Transactions</a>
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
            <form id="search-form" class="form-inline mb-3" method = "GET" action = "">
                <label for="start_date" class="mr-2">Start Date:</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo @$_GET['start_date']; ?>" class="form-control mr-2">
                <label for="end_date" class="mr-2">End Date:</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo @$_GET['end_date']; ?>" class="form-control mr-2">
                <label for="time_interval" class="mr-2">Time Interval:</label>
                <select id="time_interval" name="time_interval" class="form-control mr-2">
                    <option value="">Select Time</option>
                    <option value="1hr" <?php echo ($_GET['time_interval'] ?? '') == '1hr' ? 'selected' : ''; ?>>1 Hour</option>
                    <option value="2hr" <?php echo ($_GET['time_interval'] ?? '') == '2hr' ? 'selected' : ''; ?>>2 Hours</option>
                </select>

                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            <table id="reports-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Cheque Number</th>
                        <th>Transaction Date</th>
                        <th>Transaction Type</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reports as $report): ?>
                        <tr>
                            <td><?= $report['name'] ?></td>
                            <td><?= $report['email'] ?></td>
                            <td><?= $report['cheque_number'] ?></td>
                            <td><?= date('d/m/Y', strtotime($report['transaction_date'])) ?></td>

                            <td><?= $report['transaction_type']?></td>
                            <td><?= $report['amount'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



</body>
</html>
