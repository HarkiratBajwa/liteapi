<?php
declare(strict_types=1);
namespace LiteAPI\Core;
class Response{
    public function __construct(private string $c,private int $s=200,private array $h=[]){}
    public function send(){ http_response_code($this->s); foreach($this->h as $n=>$v) header("$n: $v"); echo $this->c; }
    public static function json(array $d,int $s=200,array $x=[]):self{
        return new self(json_encode($d,JSON_PRETTY_PRINT),$s,array_merge(['Content-Type'=>'application/json'],$x));
    }
}
