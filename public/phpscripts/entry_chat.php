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
/*
// ############################## CONFLICT
        //array_push($userFriends,$user); //waste time and stack space by making  a function call
        $userFriends[] = $user;
        $userFriendsID[] = $friend_id;
    }
    #--- THE NEW PART.
    $stmnt->close();
    $friend_wid_time = array();
    // get the latest timestamp associated with the userFriend and build an array contaning userFriend and the timestamp.
    // sort the array on the basis of the timestamp in descending order.
    //Could be done much more efficient, but have no time.
    $length = sizeof($userFriends);
    for($i = 0 ; $i < $length ; $i++){
        //get the latest timestamp by querying.
        $frID = $userFriendsID[$i];
        $time_friend = "";
        if(!$stmnt = $connection->prepare('SELECT msgTime from messages where ((send_id = ? and rcv_id = ?) or (send_id = ? and rcv_id = ?)) ORDER BY msgTime DESC LIMIT 1')){
            die(json_encode(array(
                'status'=>'error getting timestamp',
                'message'=>'query failed!'
            )));
        }
        if(!$stmnt->bind_param('iiii',$userid,$frID,$frID,$userid)){
            die(json_encode(array(
                'status'=>'error',
                'message'=>'binding unsuccessful!'
            )));
        }
        if(!$stmnt->execute()){
            die(json_encode(array(
                'status'=>'error while execuiting second Query',
                'message'=>'execution falied!'
            )));
        }
        if(!$stmnt->bind_result($time_friend)){
            die(json_encode(array(
                'status'=>'error',
                'msg'=>'binding failed'
            )));
        }
        $friend_wid_time[] = array('name'=>$userFriends[i],'timestamp'=>$time_friend);
    }
    function build_sorter($key){
        return function($a,$b) use ($key){
            return strnatcmp($a[$key] , $b[$key]);
        };
    }
    usort($friend_wid_time, build_sorter('timestamp'));
    $stmnt->close();
    for($i = 0 ; $i < $length ; ++$i){
        $userFriends[$i] = $friend_wid_time[$i]['name'];
		*/
        //array_push($userFriends,$user); //waste time and stack space by making function call
        $userFriends[] = $userFriend;
        $userFriendsFirstName[] = $userFriendFirstN;
        $userFriendsLastName[] = $userFriendLastN;
    }
?>