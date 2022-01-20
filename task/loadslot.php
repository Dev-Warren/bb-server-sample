<?php

$group_id = $_REQUEST['group_id'];

require_once('./connect.php');

$sql = 'SELECT us_id FROM groups WHERE ginfo_id = ?';

$stmt = $conn->prepare($sql);
$stmt->execute([$group_id]);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$memlist = $stmt->fetchAll();

$slotls = array();

foreach($memlist as $mem){
    $sql = 'SELECT start_t, end_t FROM task WHERE u_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$mem['us_id']]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $result = $stmt->fetchAll();
    
    if($result){
        foreach($result as $rl){
            $oneslot = array();

            $oneslot['start_time'] = $rl['start_t'];
            $oneslot['end_time'] = $rl['end_t'];
            array_push($slotls, $oneslot);
        }
        
    }
}

echo json_encode($slotls);


$conn = null;

?>