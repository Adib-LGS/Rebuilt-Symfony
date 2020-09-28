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
    $request->attributes->add($resultat);
    //var_dump($request->attributes);

    //callable func in routes.php
    $response = call_user_func($resultat['_controller'], $request);

}catch(ResourceNotFoundException $e){
    $response->setContent("Not FOund");
    $response->setStatusCode(404);
}

/**var_dump($resultat);
die();*/
$response->send();
