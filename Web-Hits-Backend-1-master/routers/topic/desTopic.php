<?php
    include_once 'childsTopic.php';
    function getDescriptionOfTopic($topicId){
        if($topicId === null )
        {
            http_response_code(400);
            echo prepareMessage("Bad request. If some data are strange");
            exit;
        }
        global $link;
        $message = [];
        $res = $link->query("SELECT id, name, parentId FROM topics where id='$topicId'");
        if(!$res) 
        {
            http_response_code(500);
           echo  prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
        }
        else
        {
            while($row = $res->fetch_assoc())
            {
                
            $message[] = [
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "parentId" => $row['parentId'],
                    
                ];
                
            }
        }
        $message[0] += [ "childs" => getChildsOfTopic($topicId)];
        http_response_code(200);
        echo json_encode($message);

    }
?>