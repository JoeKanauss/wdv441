<?php
require_once('../inc/NewsArticles.class.php');

$newsArticle = new NewsArticles();

$articleDataArray = array();

if(isset($_REQUEST['articleID']) && $_REQUEST['articleID'] > 0)
{
	$newsArticle->load($_REQUEST['articleID']);
	$articleDataArray = $newsArticle->articleData;
}


require_once('..//tpl/article-view.tpl.php');
?>

