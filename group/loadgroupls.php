<?php

require_once('./connect.php');

$fid = $_REQUEST['user_id'];

require_once('./fbuidtransfer.php');

$user_id = $reid;


//find out the group list for this user;
$sql = 'SELECT 
b.gi_id as groupid,
b.gname as grpName
FROM g_info b
JOIN groups a
ON b.gi_id = a.ginfo_id
WHERE a.us_id = ?
';

$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$groupls = $stmt->fetchAll();
// $return_gls = array('group_count'=>count($groupls));
$return_gls = array();
$groups = array();

foreach($groupls as $ls){

    // find out all group info and members for each group (for this user);
    $sql = 'SELECT 
    c.user_id as id,
    c.uname as `name`,
    c.img_url as imageUri,
    a.is_admin as isadmin
    FROM groups a 
    JOIN g_info b
    JOIN users c
    ON b.gi_id = a.ginfo_id AND a.us_id = c.user_id
    WHERE b.gi_id = ?
    ORDER BY b.gi_id DESC
    ';

    $stmt = $conn->prepare($sql);
    $stmt->execute([$ls['groupid']]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $groupmembers = $stmt->fetchALL();
    $ls['mem_count'] = count($groupmembers);
    $ls['members'] = $groupmembers;

    // $row = array('groups'=>$ls, 'members'=>$groupmembers, 'mem_count'=>count($groupmembers));
    $row = array('groups'=>$ls);
    array_push($groups, $row);
    
}

// $return_gls['groups'] = $groups;

echo json_encode($groups);

$conn = null;

?>