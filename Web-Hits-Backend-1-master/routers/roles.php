<?php
    include_once 'role/getRole.php';
    include_once 'role/getRoles.php';
    
    function route($method, $urlList, $requestData)
    {
        global $link;
        if($urlList[1] == null){
            getRoles();
        }
        else{
            getRole(findId($urlList[1]));
        }
 
    }

?>