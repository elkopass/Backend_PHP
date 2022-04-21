<?php
    include_once 'helper/validUpdateUser.php';
    include_once 'helper/findId.php';
    include_once 'user/changeUser.php';
    include_once 'user/deleteUser.php';
    include_once 'user/getAllUsers.php';
    include_once 'user/getUser.php';
    include_once 'user/updateRole.php';
    function route($method, $urlList, $requestData, $link)
    {
        global $link;
        $userId = findId($urlList[1]);

        switch($method)
        {
            default:
                case("POST"):
                    if($urlList[2] == "role"){
                        updateRole($userId, $requestData);
                    }
                    break;
                case("GET"):
                    if($urlList[1] != null){
                        getUser($userId);
                    }
                    else{
                        getAllUsers();
                    }

                    break;
                case("PATCH"):
                changheUser($userId, $requestData);
    
                    break;
                case("DELETE"):
                    deleteUser($userId);

                    break;        
        }
    }
?>