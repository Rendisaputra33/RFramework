<?php

namespace Rendi\Rframework\App\Core\Http;

use Rendi\Rframework\App\Core\Http\Request;

class Router extends BaseRouter
{
    public static function  get(string $path, array $control): void
    {
        self::add('GET', $path, $control);
    }

    public static function  post(string $path, array $control): void
    {
        self::add('POST', $path, $control);
    }

    public static function  put(string $path, array $control): void
    {
        self::add('PUT', $path, $control);
    }

    public function delete(string $path, array $control): void
    {
        self::add('DELETE', $path, $control);
    }
}

class BaseRouter
{
    private static array $routes = [];
    private static string $default = '/';
    private static string $method;

    protected static function add(string $met, string $pth, array $control): void
    {
        self::$routes[] = [
            'method' => $met, 'path' => $pth, 'controller' => $control[0], 'function' => $control[1]
        ];
    }

    private static function callController(array $route, array $argv)
    {
        $con = $route['controller'];
        $controller = new $con;
        $function = $route['function'];
        array_shift($argv);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'POST') {
            array_unshift($argv, new Request($_POST, $_GET));
            call_user_func_array([$controller, $function], $argv);
        } else {
            array_unshift($argv, new Request([], $_GET));
            call_user_func_array([$controller, $function], $argv);
        }
    }

    public static function run(): void
    {
        // path info
        if (isset($_SERVER['PATH_INFO'])) self::$default = explode('/?/', $_SERVER['PATH_INFO'])[0];
        // assugn a http method
        self::$method = $_SERVER['REQUEST_METHOD'];
        // mapping
        foreach (self::$routes as $route) :
            $patern = "#^" . $route['path'] . "$#";
            if (preg_match($patern, self::$default, $argv) && self::$method === $route['method']) {
                self::callController($route, $argv);
                return;
            }
        endforeach;
        // handler not found
        http_response_code(404);
        echo "controller not found";
    }
}
