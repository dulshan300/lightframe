<?php

declare(strict_types=1);


use Http\HttpRequest;


$injector = new \Auryn\Injector;

$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);

$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');

$injector->delegate('League\Plates\Engine', function () {
    $templateEngin = new League\Plates\Engine(dirname(__DIR__) . '/templates', 'php');
    $templateEngin->loadExtension(new League\Plates\Extension\Asset(getcwd(), false)); //set true if using cache
    $templateEngin->loadExtension(new Core\Utility\Template\Router()); //set true if using cache
    return $templateEngin;
});

$injector->alias('Core\Template\Renderer', 'Core\Template\PlateRender');

return $injector;
