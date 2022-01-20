<?php

$sql = 'SELECT user_id FROM users WHERE fbu_id = ?';
$stmt = $conn->prepare($sql);
$stmt->execute([$fid]);
$count = $stmt->rowCount();

if($count = 0) {

    echo json_encode('This user dones not exist');

} else {

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $getid = $stmt->fetchAll();
    $reid = $getid[0]['user_id'];

}

?>