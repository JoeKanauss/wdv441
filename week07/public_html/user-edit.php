<?php
require_once('../inc/Users.class.php');

$user = new Users();

$userDataArray = array();

$userErrorsArray = array();

if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] > 0)
{
	$user->load($_REQUEST['user_id']);
	$userDataArray = $user->userData;
}

if(isset($_POST['save']))
{
	$userDataArray = $_POST;
	
	//sanitize
	$user->sanitize($userDataArray);
	$user->set($userDataArray);
	
	//validate
	if($user->validate())
	{
		//save
		if($user->save())
		{
			header('location: user-login.php');
			exit;
		}
		else
		{
			$userErrorsArray[] = "Save failed";
		}
	}
	else
	{
		$userDataArray = $user->userData;
		
		$userErrorsArray = $user->errors;
	}
}

require_once('../tpl/user-edit.tpl.php');
?>

