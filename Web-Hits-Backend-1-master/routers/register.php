<?php
    function route($method, $urlList, $requestData)
    {
        global $link;
        $username  = $requestData->body->username;
        $user = $link->query("SELECT userId from users where username='$username'")->fetch_assoc();
        if( areUAuthor() == false)
        {
            if(is_null($user))
            {
                $password = hash("sha1", $requestData->body->password);
                $name = $requestData->body->name;
                $username = $requestData->body->username;
                $surname = $requestData->body->surname;
                //$roleId = $requestData->body->roleId;
                $userInsertResult = $link->query("INSERT INTO users(username,  name, surname, password) VALUES('$username','$name','$surname','$password')");
                if (!$userInsertResult)
                {
                    http_response_code(500);
                    echo prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
                    exit;
                }
                $token = bin2hex(random_bytes(16));
                $userAfterReg = $link->query("SELECT userId from users where username='$username'")->fetch_assoc();
                $userId = $userAfterReg['userId'];
                $tokenInsertResult = $link->query("INSERT INTO tokens(value, userID) VALUES('$token', '$userId')");
                if (!$tokenInsertResult)
                {
                    http_response_code(500);
                    echo prepareMessage("Unexpected error");
                    exit;
                }
                else
                {
                    http_response_code(200);
                    echo json_encode(["token" => $token]);
                }
            }
        }
        else{
            http_response_code(403);
            echo prepareMessage("User is already authorized");
        }
    
    }
?>