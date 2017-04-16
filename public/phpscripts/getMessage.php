<?php
	error_reporting(E_ALL);
	ini_set('display_errors',1);

    require 'db_connect.php';
    $recieverID = $_POST['uid'];
    $friendName = $_POST['name'];
    // Query to retrieve the latest message that was sen by another person----------------------------------------------
    $senderID = -1 ; // SOME random val to intialize with.
    // prepare statement.
    if(!$stmnt = $connection->prepare('SELECT userid FROM `users` where username = ?')){
        //echo "ohh no";
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
    $res = $stmnt->fetch();
    if($res == TRUE){
        //secho $senderID;
    }
    elseif($res == NULL){
        die(json_encode(array(
            'status'=>'Could not fetch the sender userID',
            'message'=>'execution falied!'
        )));
    }
    else{
        die(json_encode(array(
            'status'=>'Erro Occured while fetching',
            'message'=>'execution falied!'
        )));
    }
    //motherfucker.
    $stmnt->close();

    ######This much working perfect.
    $stmnt2 = $connection->prepare('SELECT body FROM messages where send_id = ? and rcv_id = ? ORDER BY msgTime DESC LIMIT 1');
    if(!$stmnt2) {
        echo "hello there";
        die(json_encode(array(
             'status'=>'error in second part',
             'message'=>'query failed! in second part'
         )));
    }
    $latestmessage = '';
    if(!$stmnt2->bind_param('ii',$senderID,$recieverID)){
        die(json_encode(array(
            'status'=>'error in second part',
            'message'=>'binding unsuccessful in second part!'
        )));
    }
    if(!$stmnt2->execute()){
        die(json_encode(array(
            'status'=>'error in second part',
            'message'=>'execution falied! in second part'
        )));
    }
    if(!$stmnt2->bind_result($latestmessage)){
        die(json_encode(array(
            'status'=>'error',
            'msg'=>'binding failed'
        )));
    }
    $res = $stmnt2->fetch();
    if($res == TRUE){
        #echo $latestmessage;
    }
    elseif($res == NULL){
        die(json_encode(array(
            'status'=>'Could not fetch the sender userID',
            'message'=>'execution falied!'
        )));
    }
    else{
        die(json_encode(array(
            'status'=>'Erro Occured while fetching',
            'message'=>'execution falied!'
        )));
    }
    //you too.
    $stmnt2->close();
    //close all the fucking stmnts.
    echo $latestmessage;
?>