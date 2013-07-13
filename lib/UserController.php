<?php
require("lib/DarkUser.php");
class UserController
{
	public static function add_user($pdo, $user)
	{
		$insert = $pdo->prepare("INSERT INTO `users` (`username`, `password`, `email`) VALUES(:username, :password, :email)");
		$insert->bindParam(":username", $user->get_username(), PDO::PARAM_STR);
		$insert->bindParam(":password", $user->get_password(), PDO::PARAM_STR);
		$insert->bindParam(":email", $user->get_email(), PDO::PARAM_STR);

		if (!$insert)
		{
			return false;
		}
		else
		{
			$result = $insert->execute();

			if (!$result)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
	}

	public static function logged_in()
	{
		return isset($_SESSION['uid']);
	}

	public static function fetch_user_from_id($pdo, $id)
	{
		$getuser = $pdo->prepare("SELECT * FROM `users` WHERE `id` = :id");
		$getuser->setFetchMode(PDO::FETCH_CLASS, 'DarkUser');

		$getuser->bindParam(":id", $id, PDO::PARAM_INT);
		
		if (!$getuser)
		{
			return false;
		}
		else
		{
			$getuser->execute();
			$userobj = $getuser->fetch();

			if (!$userobj)
			{
				return false;
			}
			else
			{
				return $userobj;
			}
		}
	}

	public static function fetch_user_from_name($pdo, $name)
	{
		$getuser = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :username");
		$getuser->setFetchMode(PDO::FETCH_CLASS, 'DarkUser');

		$getuser->bindParam(':username', $name, PDO::PARAM_STR);
		
		if (!$getuser)
		{
			return false;
		}
		else
		{
			$getuser->execute();
			$userobj = $getuser->fetch();

			if (!$userobj)
			{
				return false;
			}
			else
			{
				return $userobj;
			}
		}
	}
}
?>