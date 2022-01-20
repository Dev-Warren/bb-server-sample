<?php

require_once('./connect.php');

$fid = $_REQUEST['user_id'];

require_once('./fbuidtransfer.php');

$user_id = $reid;

$sql = 'SELECT 
a.tk_id as id, 
a.tname as title,
a.tdes as summary,
a.start_t as start,
a.end_t as end,
a.gp_id,
b.cname as task_category
FROM task a
JOIN tkcategory b
ON a.tcat_id = b.tkcat_id
WHERE a.u_id = ?
';

$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$tasklist = $stmt->fetchAll();

$returntkls = array();

foreach($tasklist as $tl){
    $date = strtotime($tl['start']) ;
    $datefm = date('Y-m-d', $date);

    $returntk = array();

    $returntk['id'] = $tl['id'];
    $returntk['title'] = $tl['title'];
    $returntk['summary'] = $tl['summary'];
    $returntk['day'] = $datefm;
    $returntk['start'] = $tl['start'];
    $returntk['end'] = $tl['end'];
    $returntk['gp_id'] = $tl['gp_id'];
    $returntk['task_category'] = $tl['task_category'];

    array_push($returntkls, $returntk);
    
}

echo json_encode($returntkls);

$conn = null;

?>

