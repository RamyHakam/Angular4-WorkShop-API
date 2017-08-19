<?php

$app->get("/GetPosts/{id}",function($req,$res,$args){

$id=$args['id'];
//call pars server 



//get user opject 
$OB= new $this->ParseQuery("An_Users");
$user=$OB->get($id);



$load= new $this->ParseQuery("Posts");
$load->equalTo("User",$user);
$posts=$load->find();
//var_dump($posts);

 $list= array();
foreach( $posts as $post ){

$item=array("title"=>$post->get("title"),"Body"=>$post->get("body"),"Likes"=>$post->get("Likes"),"Time"=>$post->getCreatedAt());
array_push($list,$item);
}

return $res->withJson($list,200);

});