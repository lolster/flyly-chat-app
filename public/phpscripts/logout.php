<?php
    session_start();
    if(isset($_SESSSION['id'])) {
        echo "id";
        unset($_SESSION['id']);
    }
    if(isset($_SESSSION['username'])) {
        echo "id";
        unset($_SESSION['username']);
    }
    if(isset($_SESSSION['firstname'])) {
        echo "id";
        unset($_SESSION['firstname']);
    }
    if(isset($_SESSSION['lastname'])) {
        echo "id";
        unset($_SESSION['lastname']);
    }
    if(isset($_SESSSION['email'])) {
        echo "id";
        unset($_SESSION['email']);
    }
    session_destroy();
    echo "<h2>Logged out</h2>";
?>