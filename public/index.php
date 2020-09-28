<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;


require __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();
//var_dump($request->getPathInfo());

$response = new Response();

$routes = require __DIR__ . '/../src/routes.php';

$context = new RequestContext();
$context->fromRequest($request);

//Knows all routes and knows the context of this collections routes request
$urlMatcher = new UrlMatcher($routes, $context);

try{

    $resultat = ($urlMatcher->match($request->getPathInfo()));

    //['_controller' => 'App\Controller\PageController@about']
    $className = substr($resultat['_controller'], 0, strpos($resultat['_controller'], '@'));
    //var_dump($className);

    $methodeName = substr($resultat['_controller'], strpos($resultat['_controller'], '@'), + 1);
    //var_dump($methodeName);

    //Callable
    $controller = [new $className, $methodeName];

    $request->attributes->add($resultat);
    //var_dump($request->attributes);

    //callable func in routes.php
    $response = call_user_func($controller, $request);

}catch(ResourceNotFoundException $e){
    $response->setContent("Not FOund");
    $response->setStatusCode(404);
}

/**var_dump($resultat);
die();*/
$response->send();
