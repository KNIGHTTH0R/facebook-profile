<?php

$app->post('/api/facebook/profiles',function($request,$response){
	require_once 'utils.php';
	

	$user_id = $request->getParam('id');

	$utils = new Utils();
	$fb_profile = $utils->getFacebookProfile($user_id);

	if(!is_null($fb_profile["code"])){
		switch ($fb_profile["code"]) {
			case 100:
			return $fb_profile["message"];
			break;
			case 803:
			return $fb_profile["message"];
			break;

		}

	}

	$view = $this->view->render($response, "profile.phtml", 
		["profile" => $fb_profile["profile"]]);

	return $view;
});
$app->get('/api/facebook/profiles/{id}', function($request,$response) {

	require_once 'utils.php';
	

	$user_id = $request->getAttribute('id');
	
//me: 566950866
	//$user_id = rand(0000000000,9999999999);

	$fb_response = Utils::getFacebookProfile($user_id);
	// header('Content-Type: applicaction/json');
	// echo json_encode($fb_response["profile"]);

	if(!is_null($fb_response["code"])){
		switch ($fb_response["code"]) {
			case 100:
			return $fb_response["message"];
			break;
			case 803:
			return $fb_response["message"];
			break;

		}

	}

	$view = $this->view->render($response, "profile.phtml", ["profile" => $fb_response["profile"]]);

	return $view;
});