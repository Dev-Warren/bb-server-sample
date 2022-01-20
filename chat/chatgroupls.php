<?php

require_once('./connect.php');

$fid = $_REQUEST['user_id'];

require_once('./fbuidtransfer.php');

$user_id = $reid;

$sql = 'SELECT 
b.gi_id as groupid,
b.gname as grpName
FROM g_info b
JOIN groups a
ON b.gi_id = a.ginfo_id
WHERE a.us_id = ?';

$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$groupls = $stmt->fetchAll();

echo json_encode($groupls);

$conn = null;

?>