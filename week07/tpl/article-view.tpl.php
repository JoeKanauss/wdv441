<html>
	<body>
			title: <?php echo(isset($articleDataArray['articleTitle']) ? $articleDataArray['articleTitle']: ''); ?><br>
			content:<?php echo(isset($articleDataArray['articleContent']) ? $articleDataArray['articleContent']: ''); ?><br>
			author: <?php echo(isset($articleDataArray['articleAuthor']) ? $articleDataArray['articleAuthor']: ''); ?><br>
			date:<?php echo(isset($articleDataArray['articleDate']) ? $articleDataArray['articleDate']: ''); ?><br>
			<a href="article-retrieve.php">Back to Article List</a>
	</body>
</html>