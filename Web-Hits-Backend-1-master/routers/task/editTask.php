<?php
    include_once 'helper/accessPermission.php';
    include_once 'getTask.php';
    function editTask($id, $requestData)
    {
        global $link;
        if($id === null or is_int($id))
        {
            http_response_code(400);
            prepareMessage("Bad request. If some data are strange");
            exit;
        }
        if(areUAdmin()){
            
            $name = $requestData->body->name;
            $topicId = $requestData->body->topicId;
            $description =  $requestData->body->description;
            $price =  $requestData->body->price;
            
            if( $name and ($topicId || $description || $price)) $name  = "name = '$name', ";
            elseif($name) $name  = "name = '$name' ";
            
            if( $topicId and ($description || $price)) $topicId = "topicId = '$topicId', ";
            elseif($topicId) $topicId  =  "topicId = '$topicId'";

            if( $description and $price) $description  = "description = '$description', ";
            elseif($description) $description  = "description = '$description' ";

            if( $price) $price  = "price = '$price' ";
           
            $str = "UPDATE tasks SET $name $topicId $description $price WHERE id=$id";
            
            $res = $link->query($str);
            if(!$res)
            {
                http_response_code(500);
                prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
            }
            else
            {
               getTask("$id");
            }   
            
            
       }
       else{
        http_response_code(403);
        echo prepareMessage("Authorization token are invalid");
       }
    }
?>