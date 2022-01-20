<?php

$tk_id = $_REQUEST['tk_id'];

require_once('./connect.php');

$sql = 'SELECT 
a.tname, 
a.tdes, 
b.cname, 
a.start_t, 
a.end_t, 
a.locat, 
a.gp_id
FROM task a
JOIN tkcategory b
ON a.tcat_id = b.tkcat_id
WHERE a.tk_id = ?
';

$stmt = $conn->prepare($sql);
$stmt->execute([$tk_id]);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$taskdetail = $stmt->fetchAll();

echo json_encode($taskdetail);

$conn = null;

?>