<?php 
/**
* Created by Sublime Text.
* User: Eze <eebarcoch@gmail.com>
* Date: 24/01/2017
*/

class Utils{
	
/**
	 * This method returns if exists, the posts of an  Facebook Object containing a Facebook User Profile
	 * @param  [string] $user_id [ID of the FUP we want to retrieve]
	 * @return [`Facebook\FacebookResponse` object]          [description]
	 */
public  function getFacebookPostOfUser($user_id,$limit=500, $app_id = "756456024518694", $app_secret = "2f9cf43b29da6c50311681c36392e952", 
	$default_graph_version = "v2.4"){

	$message=null;
	$code=null;
	$profile=null;
	$response=null;
	$permissions =['email','public_profile','user_friends'];

	$fb = new Facebook\Facebook([
		'app_id' => $app_id,
		'app_secret' => $app_secret,
		'default_graph_version' => $default_graph_version,
		]);
	$total_posts = array();
	$response_array = array();
	try {
  		// Returns a `Facebook\FacebookResponse` object
		$posts_request  = $fb->get('/'.$user_id.'/posts?limit='.$limit);
		

		
		$posts_response = $posts_request->getGraphEdge();
		if($fb->next($posts_response)) {
			$response_array = $posts_response->asArray();
			$total_posts = array_merge($total_posts, $response_array);
			while ($posts_response = $fb->next($posts_response)) {	
				$response_array = $posts_response->asArray();
				$total_posts = array_merge($total_posts, $response_array);	
			}
		//print_r($total_posts);
		} else {
			$posts_response = $posts_request->getGraphEdge()->asArray();
		//print_r($posts_response);
		}


	} catch(Facebook\Exceptions\FacebookResponseException $e) {

		$message ="Graph returned an error: ".$e->getMessage();
		$code = $e->getCode();
	} catch(Facebook\Exceptions\FacebookSDKException $e) {

		$message = "Facebook SDK returned an error: ".$e->getMessage();
		$code = $e->getCode();
	}







	$response = [
	"code"=>$code,
	"message"=>$message,
	"posts"=>$response_array
	];

	return $response;
}

	/**
	 * This method returns if exists, an Facebook Object containing a Facebook User Profile
	 * @param  [string] $user_id [ID of the FUP we want to retrieve]
	 * @return [`Facebook\FacebookResponse` object]          [description]
	 */
	public  function getFacebookProfile($user_id, $app_id = "756456024518694", $app_secret = "2f9cf43b29da6c50311681c36392e952", 
		$default_graph_version = "v2.8"){

		$message=null;
		$code=null;
		$profile=null;
		$response=null;
		$permissions =['email','public_profile','user_friends'];

		$fb = new Facebook\Facebook([
			'app_id' => $app_id,
			'app_secret' => $app_secret,
			'default_graph_version' => $default_graph_version,
			]);

		try {
  		// Returns a `Facebook\FacebookResponse` object
			$fb_response = $fb->get('/'.$user_id.'?fields=id,name,birthday,picture,cover,devices,education,email,hometown,gender,age_range,favorite_teams,location', 'EAAKvZCiShMCYBAGdCf3WZAcQLwn1dZBtdqoH8FGUfwkZA1Nsvz3yEWriNXrxqaVwRT94DyzPKFRSEYL1SSKzXjuzTEv3byjdA2Ky3pEyoxuHiiG8FJXy37sWprCZB1kzUBHXRVTGNyBWZAn7wvPCeXivDtyO68NeAZD');
			$profile = $fb_response->getGraphUser();
			$code = 200;

		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			
			$message ="Graph returned an error: ".$e->getMessage();
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


	public static function getAge($birthdate){

		if( $birthdate!="" && $birthdate !=null && !empty( $birthdate ) ) { 

			$birthDate = date("m-d-Y", strtotime($birthdate));
                        //explode the date to get month, day and year
			$birthDate = explode("-", $birthDate);
                        //get age from date or birthdate
			$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
				? ((date("Y") - $birthDate[2]) - 1)
				: (date("Y") - $birthDate[2]));
			return $age;
		}
		return null;


	}
}