<?php
    include_once 'helper/accessPermission.php';
    function route($method, $urlList, $requestData)
    {
        global $link;
        if(!areUAuthor())
        {
            $username = $requestData->body->username;
            $password = hash("sha1", $requestData->body->password);
            if($username == null or $password == null){
                http_response_code(400);
                echo prepareMessage("Input data incorrect");
                exit;
            }
            $user = $link->query("SELECT userId from users where username='$username' AND password='$password'")->fetch_assoc();
            if (!is_null($user))
            {
                $token = bin2hex(random_bytes(16));
                $userID = $user['userId'];
                $tokenInsertResult = $link->query("INSERT INTO tokens(value, userID) VALUES('$token', '$userID')");
                if (!$tokenInsertResult)
                {
                    http_response_code(500);
                    
                    echo prepareMessage("Unexpected error");

                }
                else
                {   
                    http_response_code(200);
                    echo json_encode(['token' => $token]);
                }
            }
            else{
                http_response_code(403);
                echo prepareMessage("Username or password are wrong");
                exit;
            }
        }
        else{
            http_response_code(403);
            echo prepareMessage("User is already authorized");
        }
        
       
    }
?>