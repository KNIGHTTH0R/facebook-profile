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