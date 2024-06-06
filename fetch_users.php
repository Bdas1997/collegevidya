<?php
require 'db.php';

$query = "SELECT id, name, email,mobile,aadhar,status FROM users WHERE role = 'customer'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
$data = [];
foreach ($users as $user) {
    if ($user['status'] == 1) {
        $user['actions'] = '<span class="badge badge-success">Approved</span>';
    } else if($user['status'] == 3) {
        $user['actions'] = '<span class="badge badge-danger">Rejected</span>';
    } else {
        $user['actions'] = '<button class="btn btn-success approve-btn" data-id="' . $user['id'] . '">Approve</button>
                            <button class="btn btn-danger reject-btn" data-id="' . $user['id'] . '">Reject</button>';
    }
    $data[] = $user;
}

echo json_encode(['data' => $data]);
