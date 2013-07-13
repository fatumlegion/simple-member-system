<?php
unset($_SESSION['uid']);
session_destroy();

header('Location: '.$this->get_site_url().$this->get_last_page());
?>