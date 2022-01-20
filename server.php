<?php


$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET'){

    echo json_encode("Don't suport this method");

} elseif($method == 'POST'){

    $op = $_REQUEST['op'];

    if($op == 'register_user'){

        require_once('./user/registeruser.php');

        registeruser();

    } elseif ($op == 'create_group'){

        require_once('./group/creategroup.php');

    } elseif ($op == 'auth'){

        require_once('./user/userauth.php');
        
    } elseif ($op == 'get_group_ls'){

        require_once('./group/loadgroupls.php');
        
    } elseif ($op == 'get_mem_detail'){

        require_once('./group/memberdetail.php');

    } elseif ($op == 'update_group'){

        echo json_encode('Update group info here');

    } elseif ($op == 'add_member'){

        require_once('./group/addmember.php');

    } elseif ($op == 'update_member'){

        echo json_encode('Update group member here');

    } elseif ($op == 'del_member'){

        echo json_encode('Delete group member here');

    } elseif ($op == 'create_task'){

        require_once('./task/createtask.php');

    } elseif ($op == 'get_tasks_ls'){

        require_once('./task/loadtaskls.php');

    } elseif ($op == 'get_task_detail'){

        require_once('./task/loadtaskdetail.php');

        // echo json_encode('Load task detail');

    } elseif ($op == 'update_task'){

        require_once('./task/updatetask.php');

    } elseif ($op == 'del_task'){

        echo json_encode('Delete task');

    } elseif ($op == 'load_slot'){
        
        require_once('./task/loadslot.php');

    } elseif ($op == 'add_msg'){

        require_once('./chat/addmsg.php');

    } elseif ($op == 'load_msg'){

        require_once('./chat/loadmsg.php');

    } elseif ($op == 'load_msgls') {

        require_once('./chat/loadmsgls.php');

    } elseif ($op == 'load_chatgroups') {

        require_once('./chat/chatgroupls.php');

    } elseif ($op == 'add_feed') {

        echo json_encode('Add post');

    } elseif ($op == 'add_comment') {

        echo json_encode('Add comment');

    } elseif ($op == 'load_feeds') {

        echo json_encode('Load feeds');

    } elseif ($op == 'load_comments') {

        echo json_encode('Load comments');

    } elseif ($op == 'indi_slot'){

        require_once('./task/loadindislot.php');

    } else {

        echo json_encode("Don't support");

    }

}

?>