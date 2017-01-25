<?php
/**
* Created by Sublime Text.
* User: Eze <eebarcoch@gmail.com>
* Date: 
*/

class UtilsTest extends PHPUnit_Framework_TestCase
{
	public function testUtilsReturnsFacebookProfile()
	{
		include_once '../../../app/api/facebook/utils.php';

		$utils = new \Utils();
		$expected = 200;

		$this->assertEquals($expected,$utils->getFacebookProfile("me"));


	}
}
