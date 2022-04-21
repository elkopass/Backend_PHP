<?php
    
    function areUAdmin(){
        $token = substr(getallheaders()['Authorization'],7);
        global $link;
        $res = $link->query("SELECT userId FROM tokens where value='$token'")->fetch_assoc();
        if(!$res){
            http_response_code(500);
            echo prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
            return false;
        }
        else{
            $userId = $res['userId'];
            $role = $link->query("SELECT roleId FROM users where userId='$userId'")->fetch_assoc();
            if(!$role){
                http_response_code(500);
                prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
            }
            else{
                if($role['roleId']=='3'){
                
                    return true;
                }
                else  return false;
            }
            
        }
       
       
        
    }
    function areUAuthor(){
        $token = substr(getallheaders()['Authorization'],7);
        global $link;
        $res = $link->query("SELECT userId FROM tokens where value='$token'")->fetch_assoc();
        if(!$res){
            
            return true;
        }
        else{
            http_response_code(500);
            echo prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
            return false;
        }
        
     
    }
 

?>
