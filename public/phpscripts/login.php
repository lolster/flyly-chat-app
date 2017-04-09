<?php
    session_start();
    require 'db_connect.php';
    $entered_username = $_POST["username"];
    $entered_password = $_POST["password"];

    if(!$stmnt = $connection->prepare('select userid, username, firstname, lastname, email, password from `users` where username = ?')){
        // die(json_encode(array(
        //     'status'=>'error',
        //     'message'=>'query failed!'
        // )));
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
        ?><html>
                <head></head>
                <body>
                    <script>
                    window.location = "/flyly-chat-app/views/login.php?s=f&m=nousername";   
                    </script>
                </body>
            </html>
        <?php
    }
    else if(!$res){
        die(json_encode(array(
            'status'=>'error',
            'msg'=>'Could not verify account at this moment. Please try again later.'
        )));
        ?><html>
                <head></head>
                <body>
                    <script>
                    window.location = "/flyly-chat-app/views/login.php?s=f";   
                    </script>
                </body>
            </html>
        <?php
    }
    else {
        if(!password_verify($entered_password, $password)) {
            // die(json_encode(array(
            //     'status' => 'error',
            //     'msg' => 'Password incorrect!'
            // )));
            ?>
            <html>
                <head></head>
                <body>
                    <script>
                    window.location = "/flyly-chat-app/views/login.php?s=f";   
                    </script>
                </body>
            </html>
            <?php
        }
        else {
            /*
            die(json_encode(array(
                'status' => 'success',
                'msg' => 'Correct!'
            )));
            */
            $_SESSION["id"] = $userid;
            $_SESSION["username"]  = $username;
            $_SESSION["firstname"] = $firstname;
            $_SESSION["lastname"] = $lastname;
            $_SESSION["email"] = $email;
            ?>
            
            <html>
                <head></head>
                <body>
                    <script>
                        window.location = "/flyly-chat-app/views/chat.php";   
                    </script>
                </body>
            </html>
            
            <?php
        }
    }
?>