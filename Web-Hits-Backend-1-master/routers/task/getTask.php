<?php
    
    function getTask($taskId){
        global $link;
        if($taskId === null or is_int($taskId))
        {
            http_response_code(400);
            prepareMessage("Bad request. If some data are strange");
            exit;
        }
        $message = [];
        if(areUAdmin()){
            $res = $link->query("SELECT id, name, topicId, description, price, isDraft FROM tasks where id='$taskId'");
            if(!$res) 
            {
                http_response_code(500);
                prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
            }
            else
            {
                while($row = $res->fetch_assoc())
                {
                    
                $message[] = [
                        "id" => $row['id'],
                        "name" => $row['name'],
                        "topicId" => $row['topicId'],
                        "description" => $row['description'],
                        "price" => $row['price'],
                        "isDraft" => $row['isDraft']
                        
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