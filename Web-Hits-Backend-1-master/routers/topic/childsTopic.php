<?php
    function retChilds($topicId){
        
        echo json_encode(getChildsOfTopic($topicId));
    }
?>