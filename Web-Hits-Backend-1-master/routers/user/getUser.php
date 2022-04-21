<?php
    function getUser($userId){
        if(areUAdmin() or getIdByToken()){
            global $link;
            $message = [];
            
            if($userId === null or is_int($userId))
            {
                http_response_code(400);
                prepareMessage("Bad request. If some data are strange");
                exit;
            }

            $str = "SELECT userId, username, roleId, name, surname FROM users where userId =?";
            $stmt = $link->prepare($str);
            $stmt->bind_param("i", $userId);

            $res = $stmt->execute();
            if(!$res) 
            {
                http_response_code(500);
                prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
            }
            else
            {
                $res = $stmt->get_result();
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
            }
            echo json_encode($message);  
        }
        else{
            http_response_code(403);
            echo prepareMessage("Authorization token are invalid");
        }
        
    }
?>