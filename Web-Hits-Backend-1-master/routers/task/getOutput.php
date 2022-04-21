<?php
    function getOutput($taskId){
        if($taskId === null or is_int($taskId))
        {
            http_response_code(400);
            prepareMessage("Bad request. If some data are strange");
            exit;
        }
        if(areUAuthor()){
            $path = "files" ."/task". $taskId . "Output";
            if (file_exists($path)) {
                http_response_code(200);
                readfile($path);
            }
            else{
                http_response_code(400);
                prepareMessage("Path do not exist");
            }
    
        }
        else{
            http_response_code(403);
            echo prepareMessage("Authorization token are invalid");
        }
    }
?>