<?php

require_once('./connect.php');

$fid = $_REQUEST['user_id'];

require_once('./fbuidtransfer.php');

$thisuser_id = $reid;
$thisgroup_id = $_REQUEST['group_id'];

$sql = 'SELECT
a.msg_id as id, 
b.fbu_id as sender_id,
b.uname as sender, 
a.gi_id as g_id,
c.gname,
a.mesg as `message` 
FROM `message` a 
JOIN users b
JOIN g_info c
ON
a.gi_id = c.gi_id
AND
a.send_id = b.user_id
WHERE a.gi_id = :thisgroup
ORDER BY
a.time
';

$stmt = $conn->prepare($sql);
$stmt->bindParam(':thisgroup', $thisgroup_id);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$msglist = $stmt->fetchAll();

echo json_encode($msglist);

$conn = null;

?>