<?php 
    function updateRole($userId, $requestData){
        if($userId === null or is_int($userId))
        {
            http_response_code(400);
            prepareMessage("Bad request. If some data are strange");
            exit;
        }
        if(areUAdmin()){
            global $link;
            $roleId  = $requestData->body->roleId;
            $userUpdateRole = $link->query("UPDATE users SET roleId='$roleId' WHERE userid='$userId'");
            if (!$userUpdateRole)
            {
                http_response_code(500);
                echo prepareMessage("Unexpected error");
            }
            else
            {
                http_response_code(200);
                echo prepareMessage("OK");
            }
        }
        else{
            http_response_code(403);
            echo prepareMessage("Authorization token are invalid");
        }
        
    }
?>