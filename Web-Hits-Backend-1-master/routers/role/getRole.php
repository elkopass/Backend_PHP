<?php
    function getRole($roleId){
        global $link;
        if($roleId === null or is_int($roleId))
            {
                http_response_code(400);
                prepareMessage("Bad request. If some data are strange");
                exit;
            }
        if(areUAuthor()){
            $message = [];
            $res = $link->query("SELECT roleId, name  FROM roles roles where roleId ='$roleId'");
            if(!$res) 
            {
                http_response_code(500);
                echo prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
            }
            else
            {
                while($row = $res->fetch_assoc())
                {
                    
                $message[] = [
                        "name" => $row['name'],
                        "roleId" => $row['roleId'],  
                    ];
                    
                }
            }
            
            http_response_code(200);
            echo json_encode($message);
        }
        else{
            http_response_code(403);
            echo prepareMessage("Authorization token are invalid");
        }
       
    } 
?>