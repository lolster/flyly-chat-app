<?php
    require 'db_connect.php';
    $entered_username = $_POST["username"];
    $entered_password = $_POST["password"];

    if(!$stmnt = $connection->prepare('select userid, username, firstname, lastname, email, password from `users` where username = ?')){
        die(json_encode(array(
            'status'=>'error',
            'message'=>'query failed!'
        )));
    }
    if(!$stmnt->bind_param('s',$entered_username)){
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

    //variables to hold result

    $userid = -1;
    $username = NULL;
    $firstname = NULL;
    $lastname = NULL;
    $email = NULL;
    $password = NULL;
    

    if(!$stmnt->bind_result($userid, $username, $firstname , $lastname, $email, $password)){
        die(json_encode(array(
            'status'=>'error',
            'msg'=>'binding failed'
        )));
    }

    $res = $stmnt->fetch();
    if($res == NULL) {
        die(json_encode(array(
            'status'=>'error',
            'msg'=>'Please check username!'
        )));
    }
    else if(!$res){
        die(json_encode(array(
            'status'=>'error',
            'msg'=>'Could not verify account at this moment. Please try again later.'
        )));
    }
    else {
        if(!password_verify($entered_password, $password)) {
            die(json_encode(array(
                'status' => 'error',
                'msg' => 'Password incorrect!'
            )));
        }
        else {
            die(json_encode(array(
                'status' => 'success',
                'msg' => 'Correct!'
            )));
        }
    }
?>