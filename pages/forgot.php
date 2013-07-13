<?php
require("lib/DarkMailer.php");

$this->set_page_title("Baka Studios - Forgotten your Password?");

$forgot = new DarkForm("forgot");

if ($forgot->is_posted())
{
	$username = StringHelper::clean($forgot->get_value("username"));

	$user = UserController::fetch_user_from_name($this->pdo, $username);

	if ($user)
	{
		$cemail = trim($user->get_email());

		if (empty($cemail))
		{
			$forgot->add_error("Sad day, it seems like you didn't specify an e-mail address when registering your account.");
			$forgot->show_form(true);
		}
		else
		{
			$key = SecurityHelper::get_forgot_key();

			$ins = $this->pdo->prepare("INSERT INTO `forgot` (`uid`, `key`) VALUES(:uid, :key)");
			$ins->bindParam(":uid", $user->get_id(), PDO::PARAM_INT);
			$ins->bindParam(":key", $key, PDO::PARAM_STR);

			if ($ins)
			{
				$ins->execute();

				$bit = explode("@", $user->get_email());

				$mail_address = substr($bit[0], 0, 2);
				$mail_address .= "****";
				$mail_address .= substr($bit[0], -2);
				$mail_address .= "@";
				$mail_address .= $bit[1];

				$mail = new DarkMailer();
				$mail->set_to($user->get_email());
				$mail->set_subject("Baka Studios - Reset your Password");
				$mail->set_body("
				Hi ".$user->get_username().",

				This is an automated message to assist you with resetting your account password over at Baka Studios.  Please follow the one-time-use link below to reset your password.

				<a href=\"".$this->get_site_url()."\"/forgot/".$key."\">".$this->get_site_url()."/?page=resetpassword&key=".$key."</a>

				Please disregard this message if you weren't expecting it.  Thanks~

				- Baka Studios Staff
				");
				$mail->send();

				echo("Sent an e-mail to ".$mail_address." with instructions on how to reset your password for your account.");
			}
		}
	}
	else
	{
		$forgot->add_error("The username that you've specified doesn't exist.");
		$forgot->show_form(true);
	}

}
else
{
	$forgot->show_form();
}
?>