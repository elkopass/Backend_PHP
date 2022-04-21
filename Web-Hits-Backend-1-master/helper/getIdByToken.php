<?php
    function getIdByToken(){
        global $link;
        $token  = substr(getallheaders()['Authorization'],7);
        $res = $link->query("SELECT userID FROM tokrns where value='$token'")->fetch_assoc();
        if(!$res) 
        {
            http_response_code(500);
            echo prepareMessage("Unexpected error");
            exit;
        }
        else
        {
           return $res['userID'];
        }
    }
?>