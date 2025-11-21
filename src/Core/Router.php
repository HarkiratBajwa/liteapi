<?php
declare(strict_types=1);
namespace LiteAPI\Core;
use LiteAPI\Core\Response;
class Router{
    private array $r=['GET'=>[], 'POST'=>[]];
    private function add($m,$p,$h,$mw){$n=rtrim($p,'/'); if($n=='')$n='/'; $this->r[$m][$n]=['h'=>$h,'mw'=>$mw];}
    public function get($p,$h,$mw=[]){$this->add('GET',$p,$h,$mw);}
    public function post($p,$h,$mw=[]){$this->add('POST',$p,$h,$mw);}
    public function dispatch($req){
        $m=$req->method(); $p=$req->path(); $rt=$this->r[$m][$p]??null;
        if(!$rt){ Response::json(['error'=>'Not Found'],404)->send(); return; }
        $h=$rt['h']; $mw=$rt['mw'];
        $core=function($rq)use($h){$res=is_array($h)?(new $h[0])->{$h[1]}($rq):$h($rq); return $res instanceof Response?$res:Response::json(['data'=>$res]);};
        $pipe=array_reduce(array_reverse($mw),fn($n,$mw)=>fn($rq)=>$mw->handle($rq,$n),$core);
        try{$pipe($req)->send();}catch(\Throwable $e){Response::json(['error'=>'Server Error'],$e->getMessage(),500);}
    }
}
