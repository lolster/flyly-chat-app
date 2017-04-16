<?php
    $servername = 'localhost';
    $username = 'root';
    $password = 'root';
    $database = 'flyly';
    $connection = new mysqli($servername, $username, $password, $database);
    if($connection->connect_error){
        die(json_encode(array(
            'status'=>'error',
            'msg'=> 'Could not connect to server!'
        )));
    }
?>