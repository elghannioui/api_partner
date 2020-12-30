<?php

namespace saweblia\jwt;
use Firebase\JWT\JWT;


class Authentication
{
    public static $selfKey = "saweblia@S2E0L2F0KEY";

 public static function jwtDecode($headers){
     if (!isset($headers['Authorization'])) {
         http_response_code(401);
         die();
     }
     $tok = explode(" ", $headers['Authorization'])[1];
     try {
         JWT::decode($tok,self::$selfKey,array('HS256'));
     }catch (\Exception $e){
         http_response_code(401);
         die();
     }
 }
}