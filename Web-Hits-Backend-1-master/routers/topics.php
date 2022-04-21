<?php
    include_once 'topic/allTopics.php';
    include_once 'topic/newTopic.php';
    include_once 'topic/childsTopic.php';
    include_once 'topic/desTopic.php';
    include_once 'topic/delTopic.php';
    include_once 'helper/findId.php';
    include_once 'topic/editTopic.php';
    include_once 'topic/editChilds.php';
    include_once 'topic/delChilds.php';
    include_once 'topic/retChilds.php';
    function route($method, $urlList, $requestData,$link)
    {
        $topicId = findId($urlList[1]);
        switch($method){
            default:
            case("POST"):
                createNewTopic($requestData);
                break;
            case("GET"):
                if($urlList[2] == "childs"){
                    retChilds($topicId);
                    break;
                }
                if($urlList[1] != null){
                    getDescriptionOfTopic($topicId);
                }
                if($urlList[1] == null){
                    getAllTopicss($requestData);
                }
                
                break;
            case("DELETE"):
                if($urlList[2] == "childs"){
                    deleteChilds($topicId, $requestData);
                }
                else{
                    deleteTopic($topicId);
                }
                
                break;
            case("PATCH"):
                if($urlList[2] == "childs"){
                    
                   editChilds($topicId,$requestData);
                }
                else{
                    editTopic($topicId,$requestData);
                }
                
                break;
        }
      
        
    }
?>