<?php

require_once('./connect.php');

$groupname = $_REQUEST['gname'];
$gdescrip = $_REQUEST['descrip'];
$fid = $_REQUEST['member_id'];
$mem_is_admin = $_REQUEST['is_admin'];
require_once('./fbuidtransfer.php');
$gmem_id = $reid;

$invi_mems = $_REQUEST['invi_mems'];

$sql = 'SELECT gi_id FROM g_info WHERE gname = ?';
$testmt = $conn->prepare($sql);
$testmt->execute([$groupname]);
$count = $testmt->rowCount();

$remsg = array();

if($count > 0){

    // echo json_encode('Group exist');
    $g = 'Group exist';

    $remsg['m_group'] = $g;
    
} else {

    $sql = 'INSERT INTO g_info (gname, gdes) VALUES (:gname, :gdescrip)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':gname', $groupname);
    $stmt->bindParam(':gdescrip', $gdescrip);
    $stmt->execute();

    $sql = 'SELECT * FROM g_info WHERE gname = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$groupname]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    $ginfoid = $result[0]['gi_id'];

    $sql = 'INSERT INTO groups (ginfo_id, us_id, is_admin) VALUES (:ginfoid, :usid, :isadmin)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ginfoid', $ginfoid);
    $stmt->bindParam(':usid', $gmem_id);
    $stmt->bindParam(':isadmin', $mem_is_admin);
    $stmt->execute();

    if(isset($invi_mems)){

        $pattern = '/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i';
        preg_match_all($pattern, $invi_mems, $matches);
        foreach($matches[0] as $email) {
            
            $sql = 'SELECT user_id FROM users WHERE email = ?';
            $testmt = $conn->prepare($sql);
            $testmt->execute([$email]);
            $count = $testmt->rowCount();

            if($count == 0) {

                // echo json_encode('this '.$email.' is not registered');
                $m = 'this '.$email.' is not registered';
                $remsg['m_mem'] = $m;

            } else {

                $testmt->setFetchMode(PDO::FETCH_ASSOC);
                $resultid = $testmt->fetchAll();

                if($resultid){
                    $memid = $resultid[0]['user_id'];

                    $mem_admin2 = '2';
    
                    $sql = 'INSERT INTO groups (ginfo_id, us_id, is_admin) VALUES (:ginfoid, :usid, :isadmin)';
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':ginfoid', $ginfoid);
                    $stmt->bindParam(':usid', $memid);
                    $stmt->bindParam(':isadmin', $mem_admin2);
                    $stmt->execute();
                }

            }

        }

    }

    $sql = 'SELECT gi_id FROM g_info WHERE gname = ?';
    $checkmt = $conn->prepare($sql);
    $checkmt->execute([$groupname]);
    $count = $checkmt->rowCount();

    if($count > 0){

        // echo json_encode("Group created");

        $g = 'Group created';

        $remsg['m_group'] = $g;

    } else {

        // echo json_encode("Failed");

        $g = 'Failed';

        $remsg['m_group'] = $g;
        

    }


}

echo json_encode($remsg);

$conn = null;

?>
