<?php
    require 'db_connect.php';
    $user = $_SESSION['username'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $userid = $_SESSION['id'];
    $email = $_SESSION['email'];
    #Changes -> need to get the first name , lastname of a particular username
    if(!$stmnt = $connection->prepare('SELECT username,firstname,lastname from users where userid in (select send_id from messages where rcv_id = ? )')){
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
    $userFriend = '';
    $userFriendFirstN = '';
    $userFriendLastN = '';
    $userFriends = array();
    $userFriendsFirstName = array();
    $userFriendsLastName = array();
    if(!$stmnt->bind_result($userFriend,$userFriendFirstN,$userFriendLastN)){
        die(json_encode(array(
            'status'=>'error',
            'msg'=>'binding failed'
        )));
    }
    while($stmnt->fetch()){
        //array_push($userFriends,$user); //waste time and stack space by making function call
        $userFriends[] = $userFriend;
        $userFriendsFirstName[] = $userFriendFirstN;
        $userFriendsLastName[] = $userFriendLastN;
    }
?>