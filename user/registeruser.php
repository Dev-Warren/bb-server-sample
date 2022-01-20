<?php

function registeruser() {

    $fb_uid = $_REQUEST['fb_uid'];
    $u_name = $_REQUEST['uname'];
    $ps_word = $_REQUEST['psword'];
    $uemail = $_REQUEST['email'];
    $uorg = $_REQUEST['org'];
    $upro = $_REQUEST['pro'];
    $uimg_url = $_REQUEST['img_url'];

    require_once('./connect.php');

    $sql = 'SELECT user_id FROM users WHERE email = ?';
    $testmt = $conn->prepare($sql);
    $testmt->execute([$uemail]);
    $count = $testmt->rowCount();

    if($count >0 ){

        echo json_encode('Email exist');

    } else {

        $sql2 = 'SELECT user_id FROM users WHERE uname = ?';
        $testmt2 = $conn->prepare($sql2);
        $testmt2->execute([$u_name]);
        $count2 = $testmt2->rowCount();

        if($count2 > 0){

            echo json_encode('Username exist');

        } else {

            $sql2 = 'SELECT user_id FROM users WHERE fbu_id = ?';
            $testmt2 = $conn->prepare($sql2);
            $testmt2->execute([$fb_uid]);
            $count2 = $testmt2->rowCount();

            if ($count2 > 0){

                echo json_encode('Firebase id exist');

            } else {

                $sql = 'INSERT INTO users (uname, pword, email, org, pro, img_url, fbu_id) VALUES (:uname, :psword, :email, :org, :pro, :img_url, :fbuid)';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':uname', $u_name);
                $stmt->bindParam(':psword', $ps_word);
                $stmt->bindParam(':email', $uemail);
                $stmt->bindParam(':org', $uorg);
                $stmt->bindParam(':pro', $upro);
                $stmt->bindParam(':img_url', $uimg_url);
                $stmt->bindParam(':fbuid', $fb_uid);
        
                $stmt->execute();
        
                $sql = 'SELECT user_id FROM users WHERE email = ?';
                $testmt = $conn->prepare($sql);
                $testmt->execute([$uemail]);
                $count = $testmt->rowCount();
        
                if($count > 0) {
        
                    echo json_encode('User added!');  
                    
                            
                } else {
        
                    echo json_encode('Failed!');
        
                }

            }

        }

    }

    $conn = null;

}

?>