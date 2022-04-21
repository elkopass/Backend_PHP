<?php
    function uploadOutput($taskId){
        if($taskId === null or is_int($taskId))
        {
            http_response_code(400);
            prepareMessage("Bad request. If some data are strange");
            exit;
        }
        if(areUAdmin()){
            $input = $_FILES["input"];
            $uploads_dir = "files";
            $tmp_name = $input["tmp_name"];
            
            if ($input["type"] !== "text/plain"){
                http_response_code(400);
                echo prepareMessage("Unsupported file type");
                exit;
            }
            if ($input["error"] != 0){
                http_response_code(400);
                echo prepareMessage("Loading error");
                exit;
            }

            move_uploaded_file($tmp_name, $uploads_dir ."/task". $taskId . "Output");
            http_response_code(200);
            echo prepareMessage("OK");
        }
        else{
            http_response_code(403);
            echo prepareMessage("Authorization token are invalid");
        }

    }
?>