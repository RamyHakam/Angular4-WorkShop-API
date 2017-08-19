<?php 

$app->get("/SignIn/{phone}/{password}",function($req,$res,$args){

//get the data from the reqest
$phone=$args['phone'];
$password=$args['password'];

//Check for user in db

$load= new $this->PasrsQuery("An_Users");
$load->equalTo("phone",$phone);
$load->equalTo("password",$password);
$load->first();

if(isset($load)){
echo "ok";

}
else {
echo "error";

}


});