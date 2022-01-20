<?php

require_once('./connect.php');

$taskname = $_REQUEST['tkname'];
$tkdescrip = $_REQUEST['descrip'];
$cat_id = $_REQUEST['category_id'];
$start = $_REQUEST['start_t'];
$end = $_REQUEST['end_t'];
$location = $_REQUEST['loca'];
$groupid = $_REQUEST['group_id'];
$fid = $_REQUEST['user_id'];
require_once('./fbuidtransfer.php');
$userid = $reid;

$sql = 'INSERT INTO task (tname, tdes, tcat_id, start_t, end_t, locat, u_id, gp_id) VALUES (:tname, :tdes, :cat_id, :start_t, :end_t, :locat, :u_id, :gp_id)';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':tname', $taskname);
$stmt->bindParam(':tdes', $tkdescrip);
$stmt->bindParam(':cat_id', $cat_id);
$stmt->bindParam(':start_t', $start);
$stmt->bindParam(':end_t', $end);
$stmt->bindParam(':locat', $location);
$stmt->bindParam(':u_id', $userid);
$stmt->bindParam(':gp_id', $groupid);
$stmt->execute();

echo json_encode("Task created");

$conn = null;


?>