<?php

require_once('./connect.php');

// $fid = $_REQUEST['m_id'];

// require_once('./fbuidtransfer.php');

// $m_id = $reid;
$m_id = $_REQUEST['m_id'];

$sql = 'SELECT user_id, uname, img_url FROM users WHERE user_id = ?';

$stmt = $conn->prepare($sql);
$stmt->execute([$m_id]);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$memdetail = $stmt->fetchAll();

echo json_encode($memdetail);

$conn = null;

?>