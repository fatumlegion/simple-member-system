<?php
class GetHelper
{
	var $get;

	public function __construct($get)
	{
		$this->get = $get;
	}

	public function test()
	{
		if (isset($_GET[$this->get]))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function get_value()
	{
		return $_GET[$this->get];
	}
}
?>