<?php
    function deleteOutput($taskId){
        if($taskId === null or is_int($taskId))
        {
            http_response_code(400);
            prepareMessage("Bad request. If some data are strange");
            exit;
        }
        if(areUAdmin()){
            $path = "files" ."/task". $taskId . "Output";
            if (file_exists($path)) {
            
                unlink($path);
                http_response_code(200);
                echo prepareMessage("OK");
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

    function isFileOutEx($taskId){
        $path = "files" ."/task". $taskId . "Output";
            if (file_exists($path)) {
                return true;
            }
            else{
                return false;
            }
    }
?>