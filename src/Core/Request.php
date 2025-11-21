<?php
declare(strict_types=1);
namespace LiteAPI\Core;
class Request{
    private string $method,$path; private array $query,$body,$headers;
    public static function capture():self{
        $i=new self();
        $i->method=strtoupper($_SERVER['REQUEST_METHOD']??'GET');
        $uri=$_SERVER['REQUEST_URI']??'/';
        $path=parse_url($uri,PHP_URL_PATH)?:'/';
        $n=rtrim($path,'/'); $i->path=$n==''?'/':$n;
        $i->query=$_GET; $i->headers=self::h();
        $raw=file_get_contents('php://input')?:''; $j=json_decode($raw,true);
        $i->body=(json_last_error()==0&&is_array($j))?$j:$_POST;
        return $i;
    }
    private static function h():array{
        $h=[]; foreach($_SERVER as $k=>$v){ if(str_starts_with($k,'HTTP_')){ 
            $name=strtolower(str_replace('_','-',substr($k,5))); $h[$name]=$v;}}
        if(isset($_SERVER['CONTENT_TYPE']))$h['content-type']=$_SERVER['CONTENT_TYPE'];
        if(isset($_SERVER['CONTENT_LENGTH']))$h['content-length']=$_SERVER['CONTENT_LENGTH'];
        return $h;
    }
    public function method(){return $this->method;}
    public function path(){return $this->path;}
    public function query($k,$d=null){return $this->query[$k]??$d;}
    public function input($k,$d=null){return $this->body[$k]??$d;}
    public function all(){return $this->body;}
    public function header($n,$d=null){$k=strtolower($n); return $this->headers[$k]??$d;}
    public function apiKey():?string{ return $this->header('x-api-key')??$this->query('api_key'); }
}
