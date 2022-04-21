<?php
    header('Content-type: application/json');
    include_once 'helper/accessPermission.php';
    include_once 'helper/prepareMessage.php';
    include_once 'helper/findId.php';
    include_once 'helper/validUpdateUser.php';
    function getData($method)
    {
        $data = new stdClass();
        if($method != "GET")
        {
            $data->body = json_decode(file_get_contents('php://input'));
        }
        $data->parameters = [];
            $dataGet = $_GET;
            foreach ($dataGet as $key => $value){
                if($key != "q")
                {
                    $data->parameters[$key] = $value;
                }
            }
        return $data;
    }
    function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    global  $link;
    $link = mysqli_connect("127.0.0.1", "Actor_For_Hits_Back", "iu3nYfCE27SKAET", "web-hits-backend-1");
        if(!$link){
        echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
        echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Текст ошибки error:  : " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    
   
    $url = isset($_GET['q']) ? $_GET['q'] : ' ';
    $url = rtrim($url. '/');
    $urlList = explode('/', $url);
    $router = $urlList[0];
    $requestData = getData(getMethod());

    if (file_exists(realpath(dirname(__FILE__)).'/routers/'  . $router . '.php'))
    {
        include_once 'routers/' . $router . '.php';
        route(getMethod(), $urlList, $requestData, $link);
    }
    else
    {
        http_response_code(404);
        echo prepareMessage("Do not exist such path");
    }
    
?>