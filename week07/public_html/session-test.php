<?php

session_start();

$_SESSION['user_id'] = 101;

if(!isset($_SESSION['count']))
{
	$_SESSION['count'] = 0;	
}

$_SESSION['count']++;

var_dump($_SESSION);

?>