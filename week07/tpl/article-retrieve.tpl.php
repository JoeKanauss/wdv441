<html>
	<body>
	<h1>All Articles</h1>
	<div>
		<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="GET">
			Search:
			<select name="filterColumn">
				<option value="articleTitle">Article Title</option>
				<option value="articleAuthor">Article Author</option>
				<option value="articleDate">Article Date</option>
				<option value="articleContent">Article Content</option>
			</select>
			<input type="text" name="filterText"/>
			<input type="submit" name="filter" value="Filter"/>
		</form>
	</div>
		<table>
			<tr>
				<th>Article Title - <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=articleTitle&sortDirection=ASC">A</a> <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=articleTitle&sortDirection=DESC">D</a></th>
				<th>Article Author - <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=articleAuthor&sortDirection=ASC">A</a> <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=articleAuthor&sortDirection=DESC">D</a</th>
				<th>Article Date</th>
				<th>Edit Article</th>
				<th>View Article</th>
			</tr>
			<?php foreach($articleList as $articleData)
				{ ?>
				<tr>
					<td><?php echo $articleData['articleTitle']; ?></td>
					<td><?php echo $articleData['articleAuthor']; ?></td>
					<td><?php echo $articleData['articleDate']; ?></td>
					<td><a href='articleEdit.php?articleID=<?php echo $articleData['articleID'];?>'>Edit Article</a></td>
					<td><a href='article-view.php?articleID=<?php echo $articleData['articleID'];?>'>View Article</a></td>
				</tr>
			<?php } ?>
		</table>
		<a href="articleEdit.php">Create a new Article</a>
	</body>
</html>