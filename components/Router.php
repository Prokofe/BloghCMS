<?php

class Router
{

    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    public function run()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {


            if (preg_match("~^$uriPattern$~", $uri)) {

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;
                $controllerFile = './controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null) {
                    return;
                }
            }
        }
        include_once(ROOT.'/views/404.php');
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            $subfolder = include_once (ROOT.'/config/route_path.php');
            $uri = preg_replace("/$subfolder/", "", $_SERVER['REQUEST_URI']);
            return trim($uri, '/');
        }
    }


}