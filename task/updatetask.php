<?php

require_once('./connect.php');

$tk_id = $_REQUEST['tk_id'];
$tkname = $_REQUEST['tkname'];
$tkdescrip = $_REQUEST['descrip'];
$cat_id = $_REQUEST['category_id'];
$start_t = $_REQUEST['start_t'];
$end_t = $_REQUEST['end_t'];
$location = $_REQUEST['loca'];
$groupid = $_REQUEST['group_id'];
$fid = $_REQUEST['user_id'];
require_once('./fbuidtransfer.php');
$userid = $reid;

$sql = 'UPDATE task
SET
tname = :tkname,
tdes = :tkdes,
tcat_id = :catid,
start_t = :start_t,
end_t = :end_t,
locat = :loca,
gp_id = :groupid
WHERE
tk_id = :tk_id
';

$stmt = $conn->prepare($sql);
$stmt->bindParam(':tkname', $tkname);
$stmt->bindParam(':tkdes', $tkdescrip);
$stmt->bindParam(':catid', $cat_id);
$stmt->bindParam(':start_t', $start_t);
$stmt->bindParam(':end_t', $end_t);
$stmt->bindParam(':loca', $location);
$stmt->bindParam(':groupid', $groupid);
$stmt->bindParam(':tk_id', $tk_id);
$stmt->execute();

echo json_encode('Task updated');

$conn = null

?>