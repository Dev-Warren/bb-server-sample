<?php

$m_id = $_REQUEST['m_id'];
$group_id = $_REQUEST['group_id'];
$is_admin = $_REQUEST['is_admin'];

require_once('./connect.php');

$sql = 'SELECT us_id FROM groups WHERE ginfo_id = :groupid AND us_id = :memid';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':groupid', $group_id);
$stmt->bindParam(':memid', $m_id);
$stmt->execute();
$count = $stmt->rowCount();

if($count > 0){

    echo json_encode('Member is aleardy in this group');

} else {

    $sql = 'INSERT INTO groups (ginfo_id, us_id, is_admin) VALUES (:ginfoid, :usid, :isadmin)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ginfoid', $group_id);
    $stmt->bindParam(':usid', $m_id);
    $stmt->bindParam(':isadmin', $is_admin);
    $stmt->execute();

    $sql = 'SELECT gr_id FROM groups WHERE ginfo_id = :groupid AND us_id = :memid';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':groupid', $group_id);
    $stmt->bindParam(':memid', $m_id);
    $stmt->execute();
    $count = $stmt->rowCount();

    if($count > 0){

        echo json_encode('Member added!');

    } else {

        echo json_encode('Failed!');

    }
    
}


$conn = null;

?>