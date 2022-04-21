<?php

    include_once 'desTopic.php';
    function editTopic($topicId,$requestData){
        global $link;
        $name = $requestData->body->name;
        $parentId = $requestData->body->parentId;
        if(areUAdmin() && areUAuthor()){
            if($name === null && $name === ""){
                http_response_code(400);
                prepareMessage("Bad request. If some data are strange");
                exit;
            }
            $res = $link->query("UPDATE topics SET name='$name', parentId='$parentId'  WHERE id='$topicId'");
            if (!$res)
            {
                http_response_code(500);
                prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
            }
            else
            {
                http_response_code(200);
                getDescriptionOfTopic($topicId);
            }
        }
        else{
            http_response_code(403);
            echo prepareMessage("Authorization token are invalid");
        }
        
    }
?>