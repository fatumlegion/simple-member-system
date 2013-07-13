<?php
$id = new GetHelper("id");

if ($id->test())
{
	$user = UserController::fetch_user_from_name($this->pdo, StringHelper::clean($id->get_value()));

	if (!$user)
	{
		$this->set_page_title("Baka Studios - Error!");
		echo("There isn't a user with this username in our database.");
	}
	else
	{
		$this->set_page_title("Baka Studios - ".$user->get_username()."'s Profile");
		echo ('This could be a super awesome profile page for '.$user->get_username().'!');
	}
}
?>