<?php
    include_once 'desTopic.php';
    function editChilds($parentId,$requestData){
        global $link;
        if($parentId === null or is_int($parentId))
        {
            http_response_code(400);
            prepareMessage("Bad request. If some data are strange");
            exit;
        }
        $topics = $requestData->body;
        
        if(areUAdmin() && areUAuthor()){
            for ($i = 0; $i < sizeof($topics); $i++) {
                $topicId = $topics[$i];
                $res = $link->query("UPDATE topics SET parentId='$parentId'  WHERE id='$topicId'");
                if (!$res)
                {
                    http_response_code(500);
                    prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
                }
            }
            http_response_code(200);
            getDescriptionOfTopic($parentId);
        }
        else{
            http_response_code(403);
            echo prepareMessage("Authorization token are invalid");
        }
        
    }
?>