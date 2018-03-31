<?php
require_once('../inc/NewsArticles.class.php');

$newsArticle = new NewsArticles();

$articleList = $newsArticle->retrieveAll(
				(isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
				(isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null),
				(isset($_GET['filterColumn']) ? $_GET['filterColumn'] : null),
				(isset($_GET['filterText']) ? $_GET['filterText'] : null)
				);

require_once("../tpl/article-retrieve.tpl.php");
?>
