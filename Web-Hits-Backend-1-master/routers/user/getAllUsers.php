<?php
    function getAllUsers(){
        if(areUAdmin())
        {
            global $link;
            $message = [];
            $res = $link->query("SELECT userId, username, roleId, name, surname FROM users ORDER BY userId ASC");
            if(!$res) 
            {
                echo "500";
                echo prepareMessage("Unexpected error");
            }
            else
            {
                while($row = $res->fetch_assoc())
                {
                    
                $message[] = [
                        "userId" => $row['userId'],
                        "username" => $row['username'],
                        "roleId" => $row['roleId'],
                        "name" => $row['name'],
                        "surname" => $row['surname'],
                        
                    ];
                    
                }
                http_response_code(200);
                echo json_encode($message);
            }
          
        }
        else
        {
            http_response_code(403);
            echo prepareMessage("Authorization token are invalid");
        }
        
      
    }
?>