<html>
	<body>
		<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
			<?php if(isset($articleErrorsArray['articleTitle']))
			{ ?>
			<div><?php echo $articleErrorsArray['articleTitle']; ?>
			</div>
			<?php } ?>
			title: <input type="text" name="articleTitle" value="<?php echo(isset($articleDataArray['articleTitle']) ? $articleDataArray['articleTitle']: ''); ?>"/><br>
			
			<?php if(isset($articleErrorsArray['articleContent']))
			{ ?>
			<div><?php echo $articleErrorsArray['articleContent']; ?>
			</div>
			<?php } ?>
			content: <textarea name="articleContent"><?php echo(isset($articleDataArray['articleContent']) ? $articleDataArray['articleContent']: ''); ?></textarea><br>
			
			<?php if(isset($articleErrorsArray['articleAuthor']))
			{ ?>
			<div><?php echo $articleErrorsArray['articleAuthor']; ?>
			</div>
			<?php } ?>
			author: <input type="text" name="articleAuthor" value="<?php echo(isset($articleDataArray['articleAuthor']) ? $articleDataArray['articleAuthor']: ''); ?>"/><br>
			
			<?php if(isset($articleErrorsArray['articleDate']))
			{ ?>
			<div><?php echo $articleErrorsArray['articleDate']; ?>
			</div>
			<?php } ?>
			date: <input type="text" name="articleDate" value="<?php echo(isset($articleDataArray['articleDate']) ? $articleDataArray['articleDate']: ''); ?>"/><br>
			
			<input type="hidden" name="articleID" value="<?php echo(isset($articleDataArray['articleID']) ? $articleDataArray['articleID']: ''); ?>"/>
			
			<input type="submit" name="save" value="Save"/>
			<input type="submit" name="cancel" value="Cancel"/>
		</form>
	</body>
</html>