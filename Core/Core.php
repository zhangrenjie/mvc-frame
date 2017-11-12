<?php
/**
 * Created by PhpStorm.
 * User: zrj
 * Date: 17-11-12
 * Time: 下午2:11
 */
declare(strict_types=1);//开启强类型模式

define('CORE_PATH', __DIR__ . '/');

class Core
{
    private static $extendsMap = [
        'Controller' => CORE_PATH . 'lib/Controller.php',
        'Model' => CORE_PATH . 'lib/Model.php',
    ];

    public static function run()
    {
        print_r($_SERVER['PATH_INFO']);
        spl_autoload_register('Core::autoLoad');
        $routeInfo = self::route();

        $controller = $routeInfo['c'];
        $action = $routeInfo['a'];
        return (new $controller)->$action();
    }

    private static function route(): array
    {
        $controllerName = $actionName = '';
        if (isset($_SERVER['PATH_INFO']) && trim($_SERVER['PATH_INFO']) != '') {
            $pathInfo = trim(trim($_SERVER['PATH_INFO']), '/');
            list($controllerName, $actionName) = explode('/', $pathInfo);
        } else {
            $controllerName = $_GET['c'] ?? '';
            $actionName = $_GET['a'] ?? '';
        }

        if ($controllerName == '') {
            $controllerName = 'Index';
        }

        if ($actionName == '') {
            $actionName = 'index';
        }

        return ['c' => ucfirst($controllerName) . 'Controller', 'a' => lcfirst($actionName)];
    }

    private static function autoLoad($className)
    {
        if (isset(Core::$extendsMap[$className])) {
            echo 'load extends...<br/>';
            require Core::$extendsMap[$className];
        } elseif (substr($className, -10) == 'Controller') {
            echo 'load controller...<br/>';
            require APP_PATH . 'Controller/' . $className . '.class.php';
        } elseif (substr($className, -5) == 'Model') {
            echo 'load Model...<br/>';
            require APP_PATH . 'Model/' . $className . '.php';
        }
    }
}