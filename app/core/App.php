<?php

class App
{   
    protected $controller = 'home';
    protected $method = 'landingPage';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
        $this->loadController($url);
        $this->executeControllerMethod($url);
    }

    private function loadController($url)
    {
        if (isset($url[0]) && $this->controllerExists($url[0]))
        {
            $this->controller = $url[0];
            unset($url[0]);
        }
        require_once $this->getControllerPath();
        $this->controller = new $this->controller;
    }

    private function controllerExists($controllerName)
    {
        return file_exists(__DIR__ . '/../controllers/' . $controllerName . '.php');
    }

    private function getControllerPath()
    {
        return __DIR__ . '/../controllers/' . $this->controller . '.php';
    }

    private function executeControllerMethod($url)
    {
        if (isset($url[2])) {
            $this->params = array_values($url);
        }

        if (isset($url[1])) {
            $this->method = $url[1];
        }

        if (method_exists($this->controller, $this->method)) {
            call_user_func_array([$this->controller, $this->method], $this->params);
        }
    }

    private function sanitizeUrl()
    {
        $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        return $url;
    }

    private function parseUrl()
    {
        if(isset($_GET['url']))
        {
            $urlSanitize = $this->sanitizeUrl();
            return $urlSanitize;
        }
    }
}
