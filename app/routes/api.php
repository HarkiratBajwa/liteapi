<?php
use LiteAPI\Http\Controllers\UserController;
use LiteAPI\Middleware\ApiKeyAuth;
$router->get('/health', fn($r)=> LiteAPI\Core\Response::json(['status'=>'ok']));
$auth=[new ApiKeyAuth()];
$router->get('/v1/users',[UserController::class,'index'],$auth);
