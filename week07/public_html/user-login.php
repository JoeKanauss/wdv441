<?php
require_once('../inc/Users.class.php');

$user = new Users();

$userDataArray = array();

$userErrorsArray = array();

if(isset($_REQUEST['login']))
{
	$userDataArray = $_POST;

	$user->sanitize($userDataArray);
	$user->set($userDataArray);
	

	$userId = $user->checkLogin($userDataArray['username'], $userDataArray['password']);
		
	if($userId)
	{
		session_start();
		$_SESSION['user_id'] = $userId;
		$sessionId = $_SESSION['user_id'];
		$user->load($sessionId);
		$userDataArray = $user->userData;
		$_SESSION['username'] = $userDataArray['username'];
		$sessionUser = $_SESSION['username'];
		header('location: user-logged.php');
		exit;
	}
	else
	{
		echo "username and password do not match";
	}
}

require_once('../tpl/user-login.tpl.php');
?>

