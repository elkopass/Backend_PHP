<?php

    function getAllSolutions($requsetData){
        if(areUAuthor()){
            global $link;
            $taskId = $requsetData->parameters['taskId'];
            $authorId = $requsetData->parameters['user'];
            $str = "SELECT id, sourceCode, programmingLanguage, verdict, authorId, taskId FROM solutions";
        
            if($taskId !== null and $authorId !== null ){
                $str  = $str . " where taskId='$taskId' and authorId='$authorId' ";
            }
            else{
                if($taskId !== null){
                    $str  = $str . " where taskId='$taskId'  ";
                }
                if($authorId !== null){
                    $str  = $str . " where  authorId='$authorId' ";
                }
            }
            $message = [];
            
            $res = $link->query($str);
            if(!$res){
                http_response_code(500);
                prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
            }
            else{
                while($row = $res->fetch_assoc())
                {
                    
                $message[] = [
                    "id" => $row['id'],
                    "sourceCode"=> $row['sourceCode'],
                    "programmingLanguage"=> $row['programmingLanguage'],
                    "verdict" => $row['verdict'],
                    "taskId" => $row['taskId'],
                    "authorId" => $row['authorId'] 
                    ];
                    
                }
                http_response_code(200);
                echo json_encode($message);
            }
           
        }
        else{
            http_response_code(403);
            echo prepareMessage("Authorization token are invalid");
        }

    }
?>