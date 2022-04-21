<?php
    include_once 'helper/accessPermission.php';
    function route($method, $urlList, $requestData,$link)
    {
        global $link;
        if(areUAuthor()){
            $token  = substr(getallheaders()['Authorization'],7);
            $res = $link->query("DELETE FROM tokens where value ='$token'");
            if(!$res) 
            {
                http_response_code(500);
                echo prepareMessage("Unexpected error");
                exit;
            }
            else
            {
                http_response_code(200);
                echo prepareMessage("User logged out");
                exit;
            }
        }
        else{
            http_response_code(403);
            echo prepareMessage("User is Unauthorized");
            exit;
        }
    
        
        
    }
?>