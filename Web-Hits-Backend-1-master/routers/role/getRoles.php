<?php
    function getRoles(){
        if(areUAuthor()){
            $message = [];
            global $link;
            $res = $link->query("SELECT roleId, name  FROM roles ORDER BY roleId ASC");
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