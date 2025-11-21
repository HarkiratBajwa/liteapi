<?php
namespace LiteAPI\Http\Controllers;
use LiteAPI\Core\Request;
use LiteAPI\Core\Response;
class UserController{
    public function index(Request $r):Response{
        return Response::json(['users'=>[['id'=>1,'name'=>'Alice'],['id'=>2,'name'=>'Bob']]]);
    }
}
