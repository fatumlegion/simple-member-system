<?php
class StringHelper
{
	static function clean($str)
	{
		$str = htmlspecialchars($str);
		$str = addslashes($str);
		return $str;
	}
}
?>