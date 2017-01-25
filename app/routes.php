<?php

$app->get('/', function ( $request, $response, $args ){
    //  return $this->response->withStatus(200)->withHeader('Location', '/api/facebook/profiles');


	$view = $this->view->render($response, "search-profile.phtml");

	return $view;
});
$app->get('/hola', function (){
    //  return $this->response->withStatus(200)->withHeader('Location', '/api/facebook/profiles');


	echo 'hola';
});
$app->map(['POST','GET'],'/profiles[/{id}]',function($request,$response){
	include_once '../app/api/facebook/facebook_profiler.php';
	$user_id="";
	$view="";
	if(($request->getParam("id") || $request->getAttribute("id"))==null){
		$view = $this->view->render($response, "search-profile.phtml");
		return $view;
	}
	if($request->isGet()){
		
		if($request->getAttribute("id")!=null){
			$user_id = $request->getAttribute('id');
		}
	}

	$user_id = $request->getParam('id');

	$utils = new FacebookProfiler();
	$fb_profile = $utils->retrieveProfile($user_id);
	if(isset($fb_profile["code"])){
		switch ($fb_profile["code"]) {
			case 100:
			case 803:
			$fb_profile["message"];		
			$view = $this->view->render($response, "error.phtml",["data" => $fb_profile["message"]]);
			break;
			case 200:
			if(isset($fb_profile["profile"]))
			{
				$view = $this->view->render($response, "profile.phtml", 
					["profile" => $fb_profile["profile"]]);
			}
			else{
				$view = $this->view->render($response, "404.phtml");
			}
			break;

		}
	}
	return $view;	


});
