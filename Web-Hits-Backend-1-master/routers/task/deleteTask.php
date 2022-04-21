<?php
    function deleteTask($taskId){
        if($taskId === null or is_int($taskId))
        {
            http_response_code(400);
            prepareMessage("Bad request. If some data are strange");
            exit;
        }
        global $link;
        if(areUAdmin()){
            $res = $link->query("DELETE FROM tasks where Id ='$taskId'");
            if(!$res) // SQL
            {
                http_response_code(500);
                prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
            }
            else
            {
                if(isFileInEx($taskId)){
                    deleteInput($taskId);
                }
                if(isFileOutEx($taskId)){
                    deleteOutput($taskId);
                }
                $resSol = $link -> query("DELETE FROM solutions where taskId='$taskId'");
                if(!$resSol){
                    http_response_code(500);
                    prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
                }
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