<?php

$app->post("/Signup",function($req,$res){
//get the data from request Body 

$data= $req->getParsedBody();

//Save the data on DB
try{
$new= new $this->ParseObject("An_Users");
$new->set("name",$data['name']);
$new->set("password",$data['password']);
$new->set("email",$data['email']);
$new->set("phone",$data['phone']);
$new->save();
//logging this action in the server log
//$this->logger>info("user has been saved successflly " );
$messag=array("status"=>true,"message"=>"user has been Created","userId"=>$new->getObjectId());

//Generate a new JWT token for this user 

$MyJWT=$this->JWT;
$now = new DateTime();
$future = new DateTime("now +1 minutes");
// $server = $request->getServerParams();
$payload = [
    "iat" => $now->getTimeStamp(),
    "exp" => $future->getTimeStamp(),
    "sub" =>"test for JWT",
];
$secret = "supersecretkeyyoushouldnotcommittogithub";
$token = $MyJWT->encode($payload, $secret, "HS512");
$messag["token"] = $token;
return $res->withStatus(201)
    ->withHeader("Content-Type", "application/json")
    ->write(json_encode($messag, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));













//return $res->withJson($messag,200,JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

}
catch ( Exception $ex){
//$this->logger>info("Error in saving new user " .$ex);
$messag=array("status"=>false,"message"=>"Error in Creating user ","error"=>$ex->getMessage());
//return the response to client 
return $res->withJson($messag,500); 

}
});


