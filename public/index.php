<?php
declare(strict_types=1);
use LiteAPI\Core\Request;
use LiteAPI\Core\Router;
ini_set('display_errors','1');
error_reporting(E_ALL);
require_once __DIR__.'/../vendor/autoload.php';
$router=new Router();
require_once __DIR__.'/../app/routes/api.php';
$request=Request::capture();
$router->dispatch($request);
