<?php
    require 'db_connect.php';
    $recieverID = $_POST["uid"];
    $friendName = $_POST["name"];
    // Query to retrieve the latest message that was sen by another person----------------------------------------------
    $senderID = 10000000; // SOME random val to intialize with.
    // prepare statement.
    if(!$stmnt = $connection->prepare('SELECT userid FROM users where name = ?')){
        die(json_encode(array(
             'status'=>'error',
             'message'=>'query failed!'
         )));
    
    }
    //binding the '?' with $friendName.
     if(!$stmnt->bind_param('s',$friendName)){
        die(json_encode(array(
            'status'=>'error',
            'message'=>'binding unsuccessful!'
        )));
    }
    //executing the statement.
    if(!$stmnt->execute()){
        die(json_encode(array(
            'status'=>'error',
            'message'=>'execution falied!'
        )));
    }
    // binding the result of the query to $senderID
    if(!$stmnt->bind_result($senderID)){
        die(json_encode(array(
            'status'=>'error',
            'msg'=>'binding failed'
        )));
    }
    if(!$stmnt = $connection->prepare('SELECT body FROM messages where send_id = ? and rcv_id = ? ORDER BY msgTime DESC LIMIT 1 ')){
        die(json_encode(array(
             'status'=>'error in second part',
             'message'=>'query failed! in second part'
         )));
    }
    $latestmessage = '';
    if(!$stmnt->bind_param('ii',$senderID,$recieverID)){
        die(json_encode(array(
            'status'=>'error in second part',
            'message'=>'binding unsuccessful in second part!'
        )));
    }
    if(!$stmnt->execute()){
        die(json_encode(array(
            'status'=>'error in second part',
            'message'=>'execution falied! in second part'
        )));
    }
    if(!$stmnt->bind_result($latestmessage)){
        die(json_encode(array(
            'status'=>'error',
            'msg'=>'binding failed'
        )));
    }
    echo $latestmessage;
?>