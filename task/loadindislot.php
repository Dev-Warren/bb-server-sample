<?php

require_once('./connect.php');

$fid = $_REQUEST['user_id'];
require_once('./fbuidtransfer.php');
$user_id = $reid;
$sub_id = $_REQUEST['subject_id'];


$sql = 'SELECT start_t as start_time, end_t as end_time FROM task WHERE u_id = :userid OR u_id = :subid';

$stmt = $conn->prepare($sql);
$stmt->bindParam(':userid', $user_id);
$stmt->bindParam(':subid', $sub_id);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$indislots = $stmt->fetchAll();

if($indislots){
    echo json_encode($indislots);
} else {
    echo json_encode('Can not find task for these two persons.');
}

$conn = null;

?>