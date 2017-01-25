<?php 
/**
* Created by Sublime Text.
* User: Eze <eebarcoch@gmail.com>
* Date: 24/01/2017
*/
class FacebookProfiler{

	private $app_id; 
	private $app_secret;
	protected $default_graph_version;
	
	public function __construct(){
		$this->app_id = "756456024518694";
		$this->app_secret = "2f9cf43b29da6c50311681c36392e952";
		$this->default_graph_version ="v2.8";
	}
	/**
	 * This method returns if exists, an Facebook Object containing a Facebook User Profile
	 * @param  [string] $user_id [ID of the FUP we want to retrieve]
	 * @return [`Facebook\FacebookResponse` object]          [description]
	 */
	public  function retrieveProfile($user_id)
	{
		$message=null;
		$code=null;
		$profile=null;
		$response=null;
		$permissions =['email'];

		

		$fb = new Facebook\Facebook([
			'app_id' => $this->app_id,
			'app_secret' =>  $this->app_secret,
			'default_graph_version' =>  $this->default_graph_version,
			]);

	// 	$helper = $fb->getRedirectLoginHelper();

	// 	try {
	// 		if (isset($_SESSION['facebook_access_token'])) {
	// 			$accessToken = $_SESSION['facebook_access_token'];
	// 		} else {
	// 			$accessToken = $helper->getAccessToken();
	// 		}
	// 	}catch(Facebook\Exceptions\FacebookResponseException $e) {
	// 	// When Graph returns an error
	// 		$message ="Graph returned an error: ".$e->getMessage();
	// 		$code = $e->getCode();
	// 		session_destroy();
	// 	// redirecting user back to app login page

	// 	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	// 	// When validation fails or other local issues
	// 		$message = "Facebook SDK returned an error: ".$e->getMessage();
	// 		$code = $e->getCode();
	// 	}
	// 	if (isset($accessToken) && ($accessToken!="" )) {
			
	// 		if (isset($_SESSION['facebook_access_token'])) {
	// 			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	// 		} else {
	// 	// getting short-lived access token
	// 			$_SESSION['facebook_access_token'] = (string) $accessToken;
	//   	// OAuth 2.0 client handler
	// 			$oAuth2Client = $fb->getOAuth2Client();
	// 	// Exchanges a short-lived access token for a long-lived one
	// 			$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
	// 			$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
	// 	// setting default access token to be used in script
	// 			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	// 		}
	// // redirect the user back to the same page if it has "code" GET variable
	// 		if(isset($_GET["code"])){
	// 			header('Location: ./');
	// 		}

	// // getting basic info about user
	// 		try {
	// 			$profile_request = $fb->get('/'.$user_id.'?fields=id,first_name,last_name,name,birthday,picture,cover,devices,education,email,hometown,gender,age_range,favorite_teams,location','EAACEdEose0cBAFryu5lKAOroZBsONLVcYnUKiwYJRZAuitzL7lpaZBgiFhvjYXlNBh9cnHzo8lp8AISIo63nuoYhU04xYUQZC1C0mBY2FDZCt9IhyGEXNtTHxRhS8mZCFgE1ZAj5xdueWwfCb8Wb1UlPsm0ebA0xhVF26jjc7bJIgZDZD');
	// 			$profile = $profile_request->getGraphNode()->asArray();

	// 			$code = 200;
	// 		} catch(Facebook\Exceptions\FacebookResponseException $e) {
	// 	// When Graph returns an error
	// 			$message ="Graph returned an error: ".$e->getMessage();
	// 			$code = $e->getCode();
	// 			session_destroy();
	// 	// redirecting user back to app login page

	// 		} catch(Facebook\Exceptions\FacebookSDKException $e) {
	// 	// When validation fails or other local issues
	// 			$message = "Facebook SDK returned an error: ".$e->getMessage();
	// 			$code = $e->getCode();
	// 		}

	// 		$response = [
	// 		"code"=>$code,
	// 		"message"=>$message,
	// 		"profile"=> $profile
	// 		];

	// 		return $response;


	// 	}else {

	// 		$loginUrl = $helper->getLoginUrl('http://aivo-test.dev/', $permissions);
	// 		echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
	// 	}
try {
  		// Returns a `Facebook\FacebookResponse` object
			$fb_response = $fb->get('/'.$user_id.'?fields=id,name,birthday,picture.width(80).height(80),cover,devices,education,email,hometown,gender,age_range,favorite_teams,location', 'EAAKvZCiShMCYBAGdCf3WZAcQLwn1dZBtdqoH8FGUfwkZA1Nsvz3yEWriNXrxqaVwRT94DyzPKFRSEYL1SSKzXjuzTEv3byjdA2Ky3pEyoxuHiiG8FJXy37sWprCZB1kzUBHXRVTGNyBWZAn7wvPCeXivDtyO68NeAZD');
			$profile = $fb_response->getGraphUser();
			$code = 200;
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			
			$message ="ID '".$user_id."' does not exist, cannot be loaded due to missing permissions, or does not support this operation.";
			$code = $e->getCode();
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			
			$message = "Facebook SDK returned an error: ".$e->getMessage();
			$code = $e->getCode();
		}
		$response = [
		"code"=>$code,
		"message"=>$message,
		"profile"=>$profile
		];
		return $response;
	}

}