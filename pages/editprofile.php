<?php
$this->set_page_title("Baka Studios - Edit Profile");

if (!UserController::logged_in())
{
	echo('You need to be logged in to access this page.');
}
else
{
	echo ('Awesome edit profile forms here');
}
?>
