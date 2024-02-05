<?php

namespace core;

use MongoDB\Driver\Exception\ServerException;
use SystemFailure;

class Router
{
    protected static array $routes = [];

    public static function addRoute(string $method, string $url, callable $function): void {
        self::$routes[$method][$url] = $function;
    }

    public static function matchRoute(): void{
        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];
        $serverAppFolder = config("app.server_folder");
        if (str_starts_with($url, $serverAppFolder)) {
            $url = substr($url, strlen($serverAppFolder));
        }
        if (isset(self::$routes[$method])) {
            foreach (self::$routes[$method] as $routeUrl => $target) {
                $pattern = preg_replace('/\/\{([^\/]+)\}/', '/(?P<$1>[^/]+)', $routeUrl);
                if (preg_match('#^' . $pattern . '$#', $url, $matches)) {
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY); // Only keep named subpattern matches
                    $result = call_user_func_array($target, $params);
                    echo $result;
                    exit();
                }
            }
        }
        echo "Rote not found $url";
    }
}