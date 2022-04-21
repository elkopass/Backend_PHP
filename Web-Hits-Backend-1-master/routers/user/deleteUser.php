<?php
    function deleteUser($userId){
        if($userId === null or is_int($userId))
        {
            http_response_code(400);
            prepareMessage("Bad request. If some data are strange");
            exit;
        }
        if(areUAdmin()){
            global $link;
            $res = $link->query("DELETE FROM users where userId ='$userId'");
            if(!$res) 
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