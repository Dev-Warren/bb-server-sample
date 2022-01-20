<?php

$fb_uid = $_REQUEST['fb_uid'];

require_once('./connect.php');

$sql = 'SELECT user_id FROM users WHERE fbu_id = ?';

$stmt = $conn->prepare($sql);
$stmt->execute([$fb_uid]);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$user_id = $stmt->fetchAll();

echo json_encode($user_id);


$conn = null;

?>