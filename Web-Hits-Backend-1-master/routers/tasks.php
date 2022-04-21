<?php
    include_once 'task/allTasks.php';
    include_once 'task/deleteTask.php';
    include_once 'task/editTask.php';
    include_once 'task/getTask.php';
    include_once 'task/newTask.php';
    include_once 'helper/findId.php';
    include_once 'solution/createSolution.php';
    include_once 'task/uploadInput.php';
    include_once 'task/getInput.php';
    include_once 'task/deleteInput.php';
    include_once 'task/uploadOutput.php';
    include_once 'task/getOutput.php';
    include_once 'task/deleteOutput.php';
    function route($method, $urlList, $requestData,$link)
    {
        $taskId = findId($urlList[1]);
        switch($method){
            default:
            case("POST"):
                if($urlList[2] == "solution"){
                    createSolution($taskId, $requestData);
                }
                if($urlList[1] == null){
                    createNewTask($requestData);
                }
                if($urlList[2] == "input"){
                   uploadIntup($taskId);
                }
                if($urlList[2] == "output"){
                    uploadOutput($taskId);
                }
                
                break;
            case("GET"):
                if($urlList[2] == "input"){
                   getInput($taskId);
                }
                if($urlList[2] == "output"){
                    getOutput($taskId);
                }
                if($urlList[2] ==  null)
                {
                    if($urlList[1] ==  null)
                    {
                        getAllTasks($requestData);
                    }
                    else{
                        getTask($taskId);
                    }
                }
                
                break;
            case("DELETE"):
                if($urlList[2] == "input"){
                    deleteInput($taskId);
                }
                if($urlList[2] == "output"){
                    deleteOutput($taskId);
                }
                if($urlList[2] == null){
                    deleteTask($taskId);
                }
                
                break;
            case("PATCH"):
                editTask($taskId, $requestData);
                break;
        }
      
        
    }
?>