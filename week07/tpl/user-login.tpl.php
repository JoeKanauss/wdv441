<html>
<head>
</head>
<body>
	<form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
	<?php if(isset($userErrorsArray['username']))
			{ ?>
			<div><?php echo $userErrorsArray['username']; ?>
			</div>
			<?php } ?>
			Username: <input type="text" name="username" value="<?php echo(isset($userDataArray['username']) ? $userDataArray['username']: ''); ?>"/><br>
			
			<?php if(isset($userErrorsArray['password']))
			{ ?>
			<div><?php echo $userErrorsArray['password']; ?>
			</div>
			<?php } ?>
			Password: <input type="text" name="password" value="<?php echo(isset($userDataArray['password']) ? $userDataArray['password']: ''); ?>"/>
			
			<!-- <input type="hidden" name="user_level" value="000" />--><br> 
			
			<input type="submit" name="login" value="Log In" />

	</form>
</body>