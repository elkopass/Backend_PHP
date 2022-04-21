<?php
    function changheUser($userId, $requestData){
        if(areUAuthor()){
            global $link;
            $name = $requestData->body->name;
            $surname = $requestData->body->surname;
            $password = $requestData->password;
            if($requestData->password) $password = hash("sha1", $requestData->password);

            if ($name and ($surname || $password )) $name = "name = '$name', ";
            elseif($name) $name = "name = '$name'";

            if ($surname and $password ) $surname = "surname = '$surname', ";
            elseif($surname) $surname = "surname = '$surname'";

            if ( $password ) $password = "password = '$password'";
            
            $userUpdateRezult = $link->query("UPDATE users SET $name $surname $password  WHERE userid='$userId'");
            if (!$userUpdateRezult)
            {
                http_response_code(500);
                echo prepareMessage("Unexpected error");
            }
            else
            {
               getUser($userId);
            }
        }
        else{
            http_response_code(403);
            echo prepareMessage("Authorization token are invalid");
        }
       
    }
?>