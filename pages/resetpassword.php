<?php
$key = new GetHelper("key");

if (!$key->test())
{
	$this->set_page_title("Baka Studios - Error!");
	echo("Expecting key to be passed.");
}
else
{
	$ckey = StringHelper::clean($key->get_value());

	$getkey = $this->pdo->prepare("SELECT * FROM `forgot` WHERE `key` = :key");
	$getkey->bindParam(":key", $ckey, PDO::PARAM_STR);

	if ($getkey)
	{
		$getkey->execute();
		$keyobj = $getkey->fetch();

		if (!$keyobj)
		{
			$this->set_page_title("Baka Studios - Error!");
			echo("The key you're trying to use doesn't seem to exist &mdash; maybe you've already used it?");
		}
		else
		{
			$this->set_page_title("Baka Studios - Reset your Password");
			$reset = new DarkForm("reset");

			if ($reset->is_posted())
			{
				$password = StringHelper::clean($reset->get_value("password"));
				$cpassword = StringHelper::clean($reset->get_value("cpassword"));

				$cpass = trim($password);

				if (empty($cpass))
				{
					$reset->add_error("Your new password cannot be empty.");
				}

				if ($password != $cpassword)
				{
					$reset->add_error("The passwords you've specified don't match.");
				}

				if ($reset->failed())
				{
					$reset->show_form(true);
				}
				else
				{
					$hashpass = SecurityHelper::phash($password);

					//bindParam is a bit overkill here...

					$delete = $this->pdo->prepare("DELETE FROM `forgot` WHERE `uid` = :uid");
					$delete->bindParam(":uid", $keyobj["uid"], PDO::PARAM_STR);

					if ($delete)
					{
						$delete->execute();

						//and here..

						$update = $this->pdo->prepare("UPDATE `users` SET `password` = '$hashpass' WHERE `id` = :id");
						$update->bindParam(":id", $keyobj["uid"], PDO::PARAM_STR);

						if ($update)
						{
							$update->execute();

							echo("Succesfully updated your old password.");
						}
					}
				}
			}
			else
			{
				$reset->show_form();
			}	
		}
	}
}
?>