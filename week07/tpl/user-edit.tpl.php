<html>
	<body>
		<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
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
			Password: <input type="text" name="password" value="<?php echo(isset($userDataArray['password']) ? $userDataArray['password']: ''); ?>"/><br>
			
			<?php if(isset($userErrorsArray['user_level']))
			{ ?>
			<div><?php echo $userErrorsArray['user_level']; ?>
			</div>
			<?php } ?>
			User Level: <input type="text" name="user_level" value="<?php echo(isset($userDataArray['user_level']) ? $userDataArray['user_level']: ''); ?>"/><br>
			
			<input type="hidden" name="user_id" value="<?php echo(isset($userDataArray['user_id']) ? $userDataArray['user_id']: ''); ?>"/>
			
			<input type="submit" name="save" value="Save"/>
			<input type="submit" name="cancel" value="Cancel"/>
		</form>
	</body>
</html>