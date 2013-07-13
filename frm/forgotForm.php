If you used a valid e-mail address while registering your account, you may use the form below to reset your password.<br/><br/>

<?php
if ($errors == true)
{
	echo('<span style="color: #FF0000;">'.$this->error_list[0].'</span><br/><br/>');
}
?>

<form name="forgot" method="post">
	<strong>Username</strong>:<br/>
	<input type="text" name="username" style="width: 705px;" value="<?php echo $this->get_last_value("username");?>">
	<input type="submit" name="forgot" value="Go" />
</form>