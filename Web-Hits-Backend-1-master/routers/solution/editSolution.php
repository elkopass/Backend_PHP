<?php
    
    function editSolution($solutionId, $requestData){
        if($solutionId === null or is_int($solutionId))
        {
            http_response_code(400);
            prepareMessage("Bad request. If some data are strange");
            exit;
        }
        if(areUAuthor()){
            global $link;
            $verdict = $requestData->body->verdict;
            $res = $link->query("UPDATE solutions SET verdict='$verdict' where id = '$solutionId'");
            if(!$res) 
            {
                http_response_code(500);
                prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
            }
            else
            {
                $taskId = $link->query("SELECT taskId FROM solutions where id = '$solutionId'")->fetch_assoc()['taskId'];
                if(!$taskId) 
                {
                    http_response_code(500);
                    prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
                }
                else
                {
                    getTask($taskId);
                }
           
            }
        }
        else
        {
            http_response_code(403);
            echo prepareMessage("Authorization token are invalid");
        }
    }
?>