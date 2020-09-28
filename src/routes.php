<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection;

$routes->add('hello', new Route('/hello/{name}', [
    'name' => 'World',
    '_controller' => 'App\Controller\GreetingController::hello'
]));
$routes->add('bye', new Route('/bye'), ['_controller' => 'App\Controller\GreetingController::bye']);
$routes->add('about', new Route('/a-propos'), ['_controller' => 'App\Controller\PageController::about']);

return $routes;

/* Manual way before install controller resolver via http-kernel
$routes = new RouteCollection;

$routes->add('hello', new Route('/hello/{name}', [
    'name' => 'World',
    '_controller' => 'App\Controller\GreetingController@hello'
]));
$routes->add('bye', new Route('/bye'), ['_controller' => 'App\Controller\GreetingController@bye']);
$routes->add('about', new Route('/a-propos'), ['_controller' => 'App\Controller\PageController@about']);

return $routes;
end of Manual Way */