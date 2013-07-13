<?php
class SecurityHelper
{
	public static function phash($password)
	{
		return md5("qlduqFapzYqxc1Z{fZpdlxKZa".md5($password)."f*ZpqozFpajcBzm@3iZoxspPxcI");
	}

	public static function get_forgot_key()
	{
		return sha1(rand(1337, 51293130)."-".time());
	}
}
?>