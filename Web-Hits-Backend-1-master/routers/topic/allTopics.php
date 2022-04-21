<?php
    function getAllTopicss($requestData){
        global $link;
        $name = $requestData->parameters['name'];
        $parentId = $requestData->parameters['parentId'];
        $str = "SELECT id, parentId, name FROM topics";
        
        if($name !== null and $parentId !== null ){
            $str  = $str . " where name='$name' and parentId='$parentId' ";
        }
        else{
            if($name !== null){
                $str  = $str . " where name='$name'  ";
            }
            if($parentId !== null){
                $str  = $str . " where  parentId='$parentId' ";
            }
        }
        $message = [];
        
        $res = $link->query($str);
        if(!$res) 
        {
            http_response_code(500);
            echo prepareMessage("Unexpected error");
        }
        else
        {
            while($row = $res->fetch_assoc())
            {
                
            $message[] = [
                "id" => $row['id'],
                "name" => $row['name'],
                "parentId" => $row['parentId'] 
                    
                ];
                
            }
            http_response_code(200);
            echo json_encode($message);
        }
        
        
    }
?>