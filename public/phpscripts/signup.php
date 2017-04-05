<?php
    require 'db_connect.php';
    $user = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    
    if(!$stmt = $connection->prepare('insert into `users`(`username`, `firstname`, `lastname`, `email`, `password`) values(?, ?, ?, ?, ?)')) {
        die(json_encode(array(
            'status' => 'error',
            'msg' => 'Action failed!'
        )));
    }

    if(!$stmt->bind_param('sssss',$user, $firstname, $lastname, $email, $password)) {
        die(json_encode(array(
            'status'=> 'error',
            'msg'=>'Signup failed! Try again later'
        )));
    }
    
    $password = password_hash($password, PASSWORD_DEFAULT);

    if (!$stmt->execute()) {
        die(json_encode(array(
            'status' => 'error',
            'msg' => 'Could not perform this action! Please check your username!'
        )));
    }

    die(json_encode(array(
        'status' => 'success',
        'msg' => 'User creation successful!'
    )));
?>