<?php
    include_once 'helper/accessPermission.php';
    include_once 'getTask.php';
    function createNewTask($requestData)
    {
        global $link;
   
        if( areUAdmin()){
        
            $name = $requestData->body->name;
            $topicId = $requestData->body->topicId;
            $description =  $requestData->body->description;
            $price =  $requestData->body->price;
            $str = "";
            $strValue = "";
            if( $name and ($topicId || $description || $price)){
                $str = "name, ";
                $strValue = "'$name', ";
            } 
            elseif($name){
                $str = "name ";
                $strValue = "'$name' ";
            } 
            
            if( $topicId and ($description || $price)){
                $str = $str . "topicId, ";
                $strValue = $strValue . "$topicId, ";
            } 
            elseif($topicId){
                $str = $str . "topicId";
                $strValue = $strValue . "$topicId";
            } 
            if( $description and $price){
                $str = $str . "description, ";
                $strValue = $strValue . "'$description', ";
            } 
            elseif($description){
                $str = $str . "description ";
                $strValue = $strValue . "'$description' ";
            }

            if( $price) {
                $str =  $str . "price";
                $strValue = $strValue . "$price" ;
            }
            
            
            $res = $link->query("INSERT INTO tasks(" . $str . " ) VALUES (" . $strValue. ")");
            if(!$res) 
            {
                http_response_code(500);
                prepareMessage("Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error);
            }
            else{
                
                $id = mysqli_insert_id($link);
                getTask("$id");
            }
       }
       else{
            http_response_code(403);
            echo prepareMessage("Authorization token are invalid");
       }
    }
?>