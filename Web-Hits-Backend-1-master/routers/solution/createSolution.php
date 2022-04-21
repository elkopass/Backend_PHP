<?php
    function createSolution($taskId,$requestData){
        if($taskId === null or is_int($taskId))
        {
            http_response_code(400);
            prepareMessage("Bad request. If some data are strange");
            exit;
        }
        global $link;
        if(areUAuthor()){
        
            $token = substr(getallheaders()['Authorization'],7);
            global $link;
            $res = $link->query("SELECT userId FROM tokens where value='$token'")->fetch_assoc();
            if(!$res) 
            {
                http_response_code(500);
                prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
            }
            else{
                $authorId = $res['userId'];
                $sourceCode = $requestData->body->sourceCode;
                $programmingLanguage = $requestData->body->programmingLanguage;
                $verdict = "OK";
                $link->query("INSERT INTO solutions(sourceCode, programmingLanguage, verdict, authorId, taskId) VALUES('$sourceCode','$programmingLanguage','$verdict','$authorId','$taskId')");
                if(!$res) 
                {
                    http_response_code(500);
                    prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
                }
                else{
                    $solutionId =(int) mysqli_insert_id($link);
                    echo $solutionId;
                    $solutionInfo = $link->query("SELECT *   FROM solutions where id=$solutionId")->fetch_assoc();
                    if(!$res) 
                    {
                        http_response_code(500);
                        prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
                    }
                    else{
                        echo json_encode([
                            'id' => $solutionInfo['id'],
                            'sourceCode' => $solutionInfo['sourceCode'],
                            'programmingLanguage' => $solutionInfo['programmingLanguage'],
                            'verdict' => $solutionInfo['verdict'],
                            'authorId' => $solutionInfo['authorId'],
                            'taskId' => $solutionInfo['taskId'],
                        ]);
                    } 
                }               
            }        
       }
       else{
            http_response_code(403);
            echo prepareMessage("Authorization token are invalid");
       }
    }
?>