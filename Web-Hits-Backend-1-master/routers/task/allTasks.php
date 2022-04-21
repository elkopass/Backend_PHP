<?php
    function getAllTasks($requestData){
        global $link;
        $name = $requestData->parameters['name'];
        $topicId = $requestData->parameters['topicId'];
        $str = "SELECT id, topicId, name FROM tasks";
        
        if($name !== null and $topicId !== null ){
            $str  = $str . " where name='$name' and topicId='$topicId' ";
        }
        else{
            if($name !== null){
                $str  = $str . " where name='$name'  ";
            }
            if($topicId !== null){
                $str  = $str . " where  topicId='$topicId' ";
            }
        }
        $message = [];
        
        $res = $link->query($str);
        if(!$res){
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
                "topicId" => $row['topicId'] 
                    
                ];
                
            }
        }
        http_response_code(200);
        echo json_encode($message);
        
    }
?>