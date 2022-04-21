<?php
    include_once 'solution/getAllSolutions.php';
    include_once 'helper/accessPermission.php';
    include_once 'solution/editSolution.php';
    include_once 'helper/findId.php';
    include_once 'task/getTask.php';
    function route($method, $urlList, $requestData,$link)
    {
        $solutionrId = findId($urlList[1]);
        switch($method)
        {
            default:
            case("GET"):
                getAllSolutions($requestData);
            break;
            case("POST"):
                editSolution($solutionrId,$requestData);
            break;
        }
    }
?>