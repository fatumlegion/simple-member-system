<?php
require("GetHelper.php");
require("StringHelper.php");
require("settings/Global.php");

class DarkSite
{
	public $pdo;
	private $page_title;
	private $site_url;
	private $page;

	public function __construct($page)
	{
		$this->test_connection();
		$this->prepare_cookies();

		$this->site_url = "http://localhost";

		$get = new GetHelper($page);
		if (!$get->test())
		{
			$this->page = "idx";
		}
		else
		{
			$this->page = $get->get_value();
		}
	}

	public function set_page_title($page_title)
	{
		$this->page_title = $page_title;
	}

	public function get_site_url()
	{
		return $this->site_url;
	}

	public function get_last_page()
	{
		return $_SESSION['last_page'];
	}

	private function test_connection()
	{
		try
		{
			$this->pdo = new PDO("mysql:dbname=".MYSQL_DATABASE.";host=".MYSQL_HOSTNAME, MYSQL_USERNAME, MYSQL_PASSWORD);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		}
		catch (PDOException $e)
		{
    		echo 'Connection failed: ' . $e->getMessage();
		}
	}

	private function get_target_page()
	{
		return "pages/".StringHelper::clean($this->page).".php";
	}

	private function prepare_cookies()
	{
		ob_start();
		session_start();
	}

	private function swap_macro($macro, $tpage, $ref, $textMode = false)
	{
		if ($textMode == false)
		{
			include($tpage);
			$contents = ob_get_clean();
		}
		else
		{
			$contents = $tpage;
		}

		return preg_replace("/\{".$macro."\}/i", $contents, $ref); 
	}

	public function display()
	{
		$tpage = $this->get_target_page();
		
		$skel = file_get_contents("skeleton/main.php");
		$skel = $this->swap_macro("LOGIN_FORM", "handle/login.php", $skel);

		if (!is_file($tpage))
		{
			$this->page = "404";
			$tpage = $this->get_target_page();
		}

		$skel = $this->swap_macro("MAIN_CONTENT", $tpage, $skel);
		$skel = $this->swap_macro("PAGE_TITLE", $this->page_title, $skel, true);
		$skel = $this->swap_macro("SITE_URL", $this->get_site_url(), $skel, true);
		echo $skel;

		$_SESSION['last_page'] = $_SERVER['REQUEST_URI'];
	}
}
?>