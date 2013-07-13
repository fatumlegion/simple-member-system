<?php
require("lib/DarkMailer.php");

$this->set_page_title("Baka Studios - Register");

$form = new DarkForm("register");

if ($form->is_posted())
{
	$username = StringHelper::clean($form->get_value("username"));
	$password = StringHelper::clean($form->get_value("password"));
	$cpassword = StringHelper::clean($form->get_value("cpassword"));
	$email = StringHelper::clean($form->get_value("email"));
	$cemail = StringHelper::clean($form->get_value("cemail"));

	$cuser = trim($username);
	$trmail = trim($email);

	$getusers = $this->pdo->query("SELECT count(*) FROM `users` WHERE `username` = '$username'");

	if ($getusers->fetchColumn() > 0)
	{
		$form->add_error("The username you're trying to register is already in-use.");
	}

	if ((strlen($cuser) < 3) || (strlen($cuser) > 25))
	{
		$form->add_error("Your username must be between 3 and 35 characters.");
	}
	
	if (empty($password))
	{
		$form->add_error("Please enter a password for your account.");
	}

	if ($password != $cpassword)
	{
		$form->add_error("The passwords you've entered don't match.");
	}

	if (!empty($trmail))
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$form->add_error("Please enter a valid e-mail address.  Example: <em>user@domain.com</em>");
		}

		if ($email != $cemail)
		{
			$form->add_error("The e-mail addresses you've entered don't match.");
		}
	}

	if ($form->failed())
	{
		$form->show_form(true);
	}
	else
	{
		$hashpass = SecurityHelper::phash($password);

		$user = new DarkUser();
		$user->set_username($username);
		$user->set_password($hashpass);
		$user->set_email($email);

		if (!UserController::add_user($this->pdo, $user))
		{
			echo("A random error occured while processing your registration request...");
		}
		else
		{
			header("Location: ".$this->get_site_url());
		}
	}
}
else
{
	$form->show_form();
}
?>