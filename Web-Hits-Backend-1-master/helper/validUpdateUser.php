<?php
    function updateUser($first){
        if($first != null && $first  != ""){
            return true;
        }
        return false;
    }
    function updateByAll($first, $second, $third){
        if(updateUser($first) == true && updateUser($second)== true && updateUser($third)== true){
            return true;
        }
        return false;
    }

?>