<?php
    function deleteInput($taskId){
        if($taskId === null or is_int($taskId))
        {
            http_response_code(400);
            prepareMessage("Bad request. If some data are strange");
            exit;
        }
        if(areUAdmin()){
            $path = "files" ."/task". $taskId . "Input";
            if (file_exists($path)) {
            
                unlink($path);
                http_response_code(200);
                echo prepareMessage("OK");
            }
            else{
                http_response_code(400);
                echo prepareMessage("Path do not exist");
            }
            
        }
        else{
            http_response_code(403);
            echo prepareMessage("Authorization token are invalid");
        }
        
    }
    function isFileInEx($taskId){
        $path = "files" ."/task". $taskId . "Input";
            if (file_exists($path)) {
                return true;
            }
            else{
                return false;
            }
    }
?>