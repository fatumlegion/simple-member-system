<?php
require("lib/DarkForm.php");
require("lib/SecurityHelper.php");
require("lib/UserController.php");

if (isset($_SESSION['uid']))
{
	$user = UserController::fetch_user_from_id($this->pdo, $_SESSION['uid']);

	if ($user)
	{
		echo('
		<div style="width: 100%; text-align: center;">Welcome Back, <strong>'.$user->get_username().'</strong>!</div>
		<a href="'.$this->get_site_url().'/profiles/'.$user->get_username().'"><div class="profileLink">View Profile</div></a>
		<a href="'.$this->get_site_url().'/editprofile/"><div class="profileLink" style="position: relative; top: 3px;">Edit Profile</div></a>
		<a href="'.$this->get_site_url().'/logout"><div class="profileLink" style="position: relative; top: 6px;">Logout</div></a>
		');
	}
	else
	{
		header('Location: '.$this->get_site_url().'/?page=logout');
	}
}
else
{
	$login = new DarkForm("login");

	if ($login->is_posted())
	{
		$username = StringHelper::clean($login->get_value("username"));
		$password = StringHelper::clean(SecurityHelper::phash($login->get_value("password")));

		$getuser = $this->pdo->prepare("SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'");
		
		if ($getuser)
		{
			$getuser->execute();

			$user = $getuser->fetch();

			if (!$user)
			{
				echo('Invalid username/password');
				$login->show_form();
			}
			else
			{
				echo $user['id'];
				$_SESSION['uid'] = $user['id'];
				setcookie("PHPSESSID", session_id(), time() + (10 * 365 * 24 * 60 * 60));
				header('Location: '.$this->get_site_url().$this->get_last_page());
			}
		}
	}
	else
	{
		$login->show_form();
	}
}
?>