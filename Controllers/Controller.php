<?php
namespace shoppingCart\Controllers;

use shoppingCart\Request;

class Controller
{
    /**
     * @var \shoppingCart\View;
     */
    protected $view;

    /**
     * @var \shoppingCart\ Request;
     */
    protected $request;

    protected $controllerName;

    public function __construct(
        \shoppingCart\View $view,
        \shoppingCart\Request $request,
        $name
    )
    {
        $this->view = $view;
        $this->controllerName = $name;
        $this->request = $request;
        $this->onLoad();
    }
    protected function onLoad() { }
    public function redirect(
        $controller = null,
        $action = null,
        $params = []
    ) {
        $requestUri = explode('/', $_SERVER['REQUEST_URI']);
        $url = "//" . $_SERVER['HTTP_HOST'] . "/";
        foreach ($requestUri as $k => $uri) {
            if ($uri == $this->controllerName) {
                break;
            }
            $url .= "$uri";
        }
        if ($controller) {
            $url .= "/$controller";
        }
        if ($action) {
            $url .= "/$action";
        }
        foreach ($params as $key => $param) {
            $url .= "/$key/$param";
        }
        header("Location: " . $url);
        exit;
    }
}