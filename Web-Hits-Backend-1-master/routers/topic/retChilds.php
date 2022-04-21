<?php
    function getChildsOfTopic($topicId){
        if($topicId === null or is_int($topicId))
        {
            http_response_code(400);
            prepareMessage("Bad request. If some data are strange");
            exit;
        }
        global $link;
        $message = [];
        $res = $link->query("SELECT id, name, parentId FROM topics where parentId='$topicId'");
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
                    "parentId" => $row['parentId']
                ];
                
            }
            http_response_code(200);
            return $message;
        }
        
        
    }
?>