<?php
namespace MF\init;

abstract class Bootstrap{
    abstract protected function initRoutes();
    private $routes;

    public function __construct(){
        $this->initRoutes();
        $this->run($this->getUrl());
    }

////////////////////////////////////////////////
    public function getRoutes(){              //
        return $this-> routes;                //
    }                                         //
    public function setRoutes(array $routes){ //
        $this->routes = $routes;              //
    }                                         //
////////////////////////////////////////////////
    protected function run($url){
        foreach($this->getRoutes() as $key => $route){
            if($url == $route['route']){
            // MONTANDO O NOME DA CLASSE;
            $class = "App\\Controllers\\".ucfirst($route['controller']);
            // INSTANCIANDO CLASSE;
            $controller = new $class;
            $action = $route['action'];
            $controller->$action();
            }
        }
    }
    protected function getUrl(){
        //CAPTURAR URL E VALORES;
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}
?>