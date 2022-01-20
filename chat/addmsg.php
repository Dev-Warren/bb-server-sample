<?php

require_once('./connect.php');

$fid = $_REQUEST['sender_id'];

require_once('./fbuidtransfer.php');

$sender_id = $reid;
$group_id = $_REQUEST['group_id'];
$message = $_REQUEST['message'];

$sql = 'INSERT INTO `message` (send_id, gi_id, mesg) VALUES (:sendid, :giid, :mesg)';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':sendid', $sender_id);
$stmt->bindParam(':giid', $group_id);
$stmt->bindParam(':mesg', $message);
$stmt->execute();

echo json_encode("Msg added");

$stmt = null;
$conn = null;

?>