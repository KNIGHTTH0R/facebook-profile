<?php
/**
* Created by Sublime Text.
* User: Eze <eebarcoch@gmail.com>
* Date: 
*/

class FacebookProfilerTest extends PHPUnit_Framework_TestCase
{
	public function testFacebookProfilerReturnsFacebookProfileWhenTheParamsIsME()
	{
		require 'vendor/autoload.php';
		include_once 'app/api/facebook/facebook_profiler.php';

		$facebook_profiler = new FacebookProfiler();
		$param = "me";
		$expected = 200;
		$profile = $facebook_profiler->retrieveProfile($param);

		$this->assertEquals($expected,$profile["code"]);


	}

	public function testFacebookProfilerReturnsFacebookProfileWhenTheParamsIsID()
	{
		require 'vendor/autoload.php';
		include_once 'app/api/facebook/facebook_profiler.php';

		$facebook_profiler = new FacebookProfiler();
		$param = "12312331";
		$expected = 200;
		$profile = $facebook_profiler->retrieveProfile($param);

		$this->assertEquals($expected,$profile["code"]);


	}

	public function testFacebookProfilerReturnsFacebook803Exception()
	{
		require 'vendor/autoload.php';
		include_once 'app/api/facebook/facebook_profiler.php';

		$facebook_profiler = new FacebookProfiler();
		$param = "asdasdasd";
		$expected = 803;
		$profile = $facebook_profiler->retrieveProfile($param);

		$this->assertEquals($expected,$profile["code"]);


	}
	
}
