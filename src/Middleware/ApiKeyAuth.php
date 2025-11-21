<?php
namespace LiteAPI\Middleware;
use LiteAPI\Core\Middleware;
use LiteAPI\Core\Request;
use LiteAPI\Core\Response;
class ApiKeyAuth implements Middleware{
    public function handle($req, callable $next){
        $cfg=require __DIR__.'/../../config/app.php';
        if(!in_array($req->apiKey(),$cfg['api_keys'])) return Response::json(['error'=>'Unauthorized'],401);
        return $next($req);
    }
}
