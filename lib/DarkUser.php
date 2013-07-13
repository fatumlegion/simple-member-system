<?php
class DarkUser
{
	private $id;
	private $username;
	private $password;
	private $email;

	public function set_username($username)
	{
		$this->username = $username;
	}

	public function set_password($password)
	{
		$this->password = $password;
	}

	public function set_email($email)
	{
		$this->email = $email;
	}

	public function get_id()
	{
		return $this->id;
	}

	public function get_username()
	{
		return $this->username;
	}

	public function get_password()
	{
		return $this->password;
	}

	public function get_email()
	{
		return $this->email;
	}
}
?>