<?php
require 'db.php'; 
$sql = "SELECT u.name, 
u.email, 
t.amount, 
t.cheque_number,
t.status,
t.account_id as id,
CASE 
    WHEN t.transaction_type = 1 THEN 'Credit'
    ELSE 'Debit'
END as transaction_type,
t.transaction_type as type

FROM transactions t
INNER JOIN users u ON t.account_id = u.id;
"; 
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
$data = [];
foreach ($users as $user) {
    if ($user['status'] == 2) {
        $user['actions'] = '<span class="badge badge-success">Approved</span>';
    } else if($user['status'] == 3) {
        $user['actions'] = '<span class="badge badge-danger">Rejected</span>';
    } else {
        $user['actions'] = '<button class="btn btn-success approve-btn" data-cheque="' . $user['cheque_number'] . '" data-id="' . $user['id'] . '" data-type="' . $user['type'] . '" data-amount="' . $user['amount'] . '">Approve</button>
                    <button class="btn btn-danger reject-btn" data-cheque="' . $user['cheque_number'] . '" data-id="' . $user['id'] . '" data-type="' . $user['type'] . '" data-amount="' . $user['amount'] . '">Reject</button>';

    }
    $data[] = $user;
}
echo json_encode(['data' => $data]);
