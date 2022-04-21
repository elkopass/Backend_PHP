<?php
    function deleteTopic($topicId){
        if($topicId === null or is_int($topicId))
        {
            http_response_code(400);
            prepareMessage("Bad request. If some data are strange");
            exit;
        }
        global $link;
        if(areUAdmin()){
            $res = $link->query("DELETE FROM topics where id ='$topicId' or parentId = '$topicId'");
            if(!$res) // SQL
            {
                http_response_code(500);
                prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
            }
            else
            {
                
                http_response_code(200);
                echo prepareMessage("OK");
            }
        }
        else{
            http_response_code(403);
            echo prepareMessage("Authorization token are invalid");
        }
        
    }
?>