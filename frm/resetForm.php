<?php
if ($errors == true)
{
	echo('<span style="color: #FF0000;">');
	foreach ($this->error_list as $e)
	{
		echo $e.'<br/>';
	}
	echo('</span><br/>');
}
?>

<form name="reset" method="post">
	<strong>New Password</strong>:<br/>
	<input type="password" name="password" style="width: 705px;" /><br/>
	<strong>Confirm New Password</strong>:<br/>
	<input type="password" name="cpassword" style="width: 705px;" /><br/>
	<input type="submit" name="reset" value="Reset your Password" />
</form>