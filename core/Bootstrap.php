<?php

declare(strict_types=1);

namespace Core;

require __DIR__ . "/../vendor/autoload.php";

error_reporting(E_ALL);

// set  environment
$env = 'development';

/**
 * Register the error handler
 */
$whoops = new \Whoops\Run;
if ($env !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function ($e) {
        echo 'Todo: Friendly error page and send an email to the developer';
    });
}
$whoops->register();

// DI intergration

$injector = include(dirname(__DIR__).'/src/Dependencies.php');
$request = $injector->make('Http\HttpRequest');
$response = $injector->make('Http\HttpResponse');

// routing

$dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {

    $routes = include(dirname(__DIR__).'/src/Router.php');

    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
});

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());
switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:

        $response->setContent('404 - Page not found');
        $response->setStatusCode(404);
        break;

    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:

        $response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
        break;

    case \FastRoute\Dispatcher::FOUND:

        $className = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $vars = $routeInfo[2];
        $args = [];
        foreach ($vars as $key => $val) {
            $args[':' . $key] = $val;
        }

        // $class = $injector->make($className);
        $content = $injector->execute($className . "::" . $method, $args);
        $response->setContent($content);

        break;
}


// end routing


foreach ($response->getHeaders() as $header) {
    header($header, false);
}

echo $response->getContent();
