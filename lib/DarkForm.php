<?php
class DarkForm
{
	private $form;
	private $error_list = array();
	private $form_values = array();

	public function __construct($form)
	{
		$this->form = $form;
	}

	public function get_value($name)
	{
		$this->form_values[$name] = $_POST[$name];
		return $_POST[$name];
	}

	public function get_last_value($name)
	{
		if (array_key_exists($name, $this->form_values))
		{
			return $this->form_values[$name];
		}
		else
		{
			return false;
		} 
	}

	public function is_posted()
	{
		if (isset($_POST[$this->form]))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function add_error($string)
	{
		$this->error_list[] = $string;
	}

	public function failed()
	{
		if (empty($this->error_list))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	public function show_form($errors = false)
	{
		require("frm/".$this->form."Form.php");
	}
}
?>