<?php
//Using this is a bit silly as it's even shorter to directly use mail();
//However, it looks nice, right?
//AND you're even saving time since the From: header is automatically filled for you!! Right?
//... right? :c

class DarkMailer
{
	private $from;
	private $to;
	private $subject;
	private $body;

	public function __construct()
	{
		$this->from = "noreply@site.com";
	}

	public function set_target($to)
	{
		$this->to = $to;
	}

	public function set_to($to)
	{
		$this->set_target($to);
	}

	public function set_subject($subject)
	{
		$this->subject = $subject;
	}

	public function set_body($body)
	{
		$this->body = $body;
	}

	public function send()
	{
		mail($this->to, $this->subject, $this->body, "From: ".$this->from);
	}
}
?>