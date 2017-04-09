<?php
    require 'db_connect.php';
    $user = $_SESSION['username'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $userid = $_SESSION['id'];
    $email = $_SESSION['email'];
    if(!$stmnt = $connection->prepare('select username from `users` where userid in (select send_id from `messages` where rcv_id = ? )')){
         die(json_encode(array(
             'status'=>'error',
             'message'=>'query failed!'
         )));
    }
    if(!$stmnt->bind_param('i',$userid)){
        die(json_encode(array(
            'status'=>'error',
            'message'=>'binding unsuccessful!'
        )));
    }
    if(!$stmnt->execute()){
        die(json_encode(array(
            'status'=>'error',
            'message'=>'execution falied!'
        )));
    }
    // variables to hold the result.
    $userFriends = array();
    if(!$stmnt->bind_result($user)){
        die(json_encode(array(
            'status'=>'error',
            'msg'=>'binding failed'
        )));
    }
    while($stmnt->fetch()){
        //array_push($userFriends,$user); //waste time and stack space by making function call
        $userFriends[] = $user;
    }
?>