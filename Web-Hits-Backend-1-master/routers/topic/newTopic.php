<?php
    include_once 'helper/accessPermission.php';
    include_once 'desTopic.php';
    function createNewTopic($requestData)
    {
        global $link;
        
        if(areUAdmin()){
        
            $name = $requestData->body->name;
            $parentId =  $requestData->body->parentId;
            if($parentId==null){
                $res = $link->query("INSERT INTO topics(name) VALUES('$name')");
                if (!$res)
                {
                    http_response_code(500);
                    prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
                }
                else{
                    $topicId = mysqli_insert_id($link);
                    getDescriptionOfTopic("$topicId");
                }
                
            }
            else{
                $res = $link->query("INSERT INTO topics(name, parentId) VALUES('$name','$parentId')");
                
                if (!$res)
                {
                    http_response_code(500);
                    prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
                }
                else
                {
                    $topicId = mysqli_insert_id($link);
                    getDescriptionOfTopic("$topicId");
                }
            }
       }
       else{
        http_response_code(403);
        echo prepareMessage("Authorization token are invalid");
    }
    }
?>