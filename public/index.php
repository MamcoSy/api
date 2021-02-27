<?php

use MamcoSy\Http\Request;
use MamcoSy\Http\Response;
use MamcoSy\Router\Router;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

require_once '../vendor/autoload.php';
require_once '../routes.php';

$request = Request::createFromGlobals();

$route = Router::dispatch($request);
try {
    $response = $route->call();

} catch (Exception $e) {
    $response = new Response(
        500,
        json_encode(['message' => 'une erreur'])
    );
}

$response->send();
