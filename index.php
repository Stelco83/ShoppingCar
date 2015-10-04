<?php
session_start();
ini_set('display_errors', 'off');
spl_autoload_register(function($className) {
    $classPathSplitted = explode('\\', $className);
    $vendor = $classPathSplitted[0];
    $classPath = str_replace(
        $vendor . "\\",
        "",
        $className
    );
    $classPath = str_replace("\\", "/", $classPath);
    if (!is_readable($classPath.'.php')) {
        throw new \Exception();
    }
    require_once $classPath . ".php";
});
$configName = getenv('CONFIG_NAME');
/**
 * @var \shoppingCart\Configs\DbConfig $dbConfigClass
 */
$dbConfigClass = '\\shoppingCart\\Configs\\'
    . $configName . '\\DbConfig';
shoppingCart\Db::setInstance(
    $dbConfigClass::USER,
    $dbConfigClass::PASS,
    $dbConfigClass::DBNAME,
    $dbConfigClass::HOST
);

$scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
$requestUri = explode('/', $_SERVER['REQUEST_URI']);
$customUri = [];
$controllerIndex = 0;
foreach ($scriptName as $k => $v) {
    if ($v == 'index.php') {
        $controllerIndex = $k;
        break;
    }
}
$actionIndex = $controllerIndex + 1;
$controllerName = $requestUri[$controllerIndex];
$actionName = $requestUri[$actionIndex];
$controllerClassName = '\\shoppingCart\\Controllers\\'
    . ucfirst($controllerName)
    . 'Controller';
$view = new \shoppingCart\View($controllerName, $actionName);


$request = [];

for($key = $actionIndex +1; $key <count($requestUri); $key += 2){
    if($key <= $actionIndex ){
        continue;
    }

    if(!isset($requestUri[$key+1]) ){
        break;
    }

    $request[$requestUri[$key]] = $requestUri[$key+1];
}
    $requestObject =  new \shoppingCart\Request($request);


try {
    $controller = new $controllerClassName(
        $view,
        $requestObject,
        $controllerName
    );
} catch (\Exception $e) {
    echo "wrong url, controller do not exist; ";
}
if (!$actionName) {
    $actionName = "index";
}
if (!method_exists($controller, $actionName)) {
    die("wrong url, action do not exist; ");
}



$controller->$actionName();
$view->render();