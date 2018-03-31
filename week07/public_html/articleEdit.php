<?php
require_once('../inc/NewsArticles.class.php');

$newsArticle = new NewsArticles();

$articleDataArray = array();

$articleErrorsArray = array();

if(isset($_REQUEST['articleID']) && $_REQUEST['articleID'] > 0)
{
	$newsArticle->load($_REQUEST['articleID']);
	$articleDataArray = $newsArticle->articleData;
}



//apply data if we have new data
if(isset($_POST['save']))
{
	$articleDataArray = $_POST;
	
	//sanitize
	$newsArticle->sanitize($articleDataArray);
	$newsArticle->set($articleDataArray);
	
	//validate
	if($newsArticle->validate())
	{
		//save
		if($newsArticle->save())
		{
			header('location: article-save-success.php');
			exit;
		}
		else
		{
			$articlesErrorArray[] = "Save failed";
		}
	}
	else
	{
		$articleDataArray = $newsArticle->articleData;
		
		$articleErrorsArray = $newsArticle->errors;
	}
}

if(isset($_POST['cancel']))
{
	header("location: article-retrieve.php");
	exit;
}

require_once('../tpl/article-edit.tpl.php');
?>
