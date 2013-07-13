You may use the form below to register an account with us over at Baka Studios.  An account gives you a whole lotta buncha features!!  While a valid e-mail address is not required to register an account, it's a good idea to use one encase you've forgotten your password.<br/><br/>

<?php
if ($errors == true)
{
	echo('
	<fieldset>
		<legend><span style="color: #FF0000;"><strong>Errors!</strong></span></legend>
		');
		foreach ($this->error_list as $e)
		{
			echo $e.'<br/>';
		}
		echo('
	</fieldset><br/>
	');
}
?>
<form name="register" method="post">
	<fieldset>
		<legend><strong>Basic Details</strong></legend>
		<strong>Username</strong>:<br/>
		<input type="text" name="username" value="<?php echo $this->get_last_value("username"); ?>"/><br/>
		<strong>Password</strong>:<br/>
		<input type="password" name="password" value="<?php echo $this->get_last_value("password"); ?>"/><br/>
		<strong>Confirm Password</strong>:<br/>
		<input type="password" name="cpassword" value="<?php echo $this->get_last_value("cpassword"); ?>" /><br/>
		<strong>E-Mail Address</strong>:<br/>
		<input type="text" name="email" value="<?php echo $this->get_last_value("email"); ?>" /><br/>
		<strong>Confirm E-Mail Address</strong>:<br/>
		<input type="text" name="cemail" value="<?php echo $this->get_last_value("cemail"); ?>" />
	</fieldset><br/>

	<fieldset>
		<legend><strong>All Done?</strong></legend>
		By clicking "Register", you're agreeing to our <a href="#">Terms of Service</a><br/>
		<input type="submit" name="register" value="Register" />
	</fieldset>
</form>