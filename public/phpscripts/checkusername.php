<?php
    require 'db_connect.php';
    $givenUserName = $_POST["username"];
    if(!($stmnt = $connection->prepare('select userid from users where username = ?'))){
        die(json_encode(array(
            'status'=>'error',
            'message'=>'query failed!'
        )));
    }
    if(!$stmnt->bind_param('s',$givenUserName)){
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
    $user_id = -1 ;// to hold the variable
    if(!$stmnt->bind_result($user_id)){
        die(json_encode(array(
            'status'=>'error',
            'msg'=>'binding failed'
        )));
    }
    $res = $stmnt->fetch();
    if($res == NULL){
        echo 'true';
    }
    else if(!$res){
        die(json_encode(array(
            'status'=>'error',
            'msg'=>'Could not verify account at this moment. Please try again later.'
        )));
    }
    else{
        echo 'false';
    }


?>