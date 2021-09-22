<?php

class Router 
{

    private $routes; //массив, который хранит все маршруты

    public function __construct() 
    {   
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include_once($routesPath);
    }

    //returns request string
    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'],'/');
        }
    }

    public function run()
    {
        ///([a-zA-Z0-9_]*?)/?([a-zA-Z0-9_]*?)/? index.php?controller=$1&action=$2&$query_string
        //index.php?controller=cabinet&action=giveaway&id=1
        //echo $_GET['controller']
        //регулярку делает сервер и возвращает глобальные переменные

        //Получить строку запроса
        $uri = $this->getURI();
        //проверить наличие такого запроса в routes.php

        foreach($this->routes as $uriPattern => $path) {
            //сравниваем $uriPattern и $uri

            if(preg_match("~$uriPattern~",$uri)) {
                //получаем внутренний путь из внешнего согласно правилу
                $internalRoute = preg_replace("~$uriPattern~",$path,$uri);
                
                //Определить контроллер, action, параметры 
                $segments = explode('/',$internalRoute);

                $controllerName = array_shift($segments).'Controller';

                $actionName = 'action'.ucfirst(array_shift($segments));

                $parameters = $segments;
                
                //подключить файл класса-контроллера
                $controllerFile = ROOT.'/controllers/'.
                    $controllerName.'.php';
                if(file_exists($controllerFile)) {                    
                    include_once($controllerFile);
                } else {
                    echo 'ERROR NO CONTROLLER in ';
                    echo $controllerFile.'<br>';
                }
                
                //создать объект, вызвать метод (action) c параметрами
                $controllerObject = new $controllerName;

                //то же самое что и $controllerObject->$actionName($parameters); - 
                //только удобней, параметры будут переданы как переменные
                //// Вызываем метод $controllerObject->actionName() с аргументами param(array)

                $result = call_user_func_array(array($controllerObject,$actionName),$parameters);
                
                if($result != null) {
                    break;
                } else {
                    include_once(ROOT.'/views/layouts/404.php');
                }

            } 
        }
    }

}