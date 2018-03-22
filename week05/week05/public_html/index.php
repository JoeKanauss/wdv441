<?php
require_once('../inc/NewsArticles.class.php');

$newsArticle = new NewsArticles();
$newsArticle -> load(1);

/*$article = array(
	"articleID"=>"",
	"articleTitle"=>"Test Article 3",
	"articleContent"=>"Testing some more content",
	"articleAuthor"=>"Joe",
	"articleDate"=>"2018-03-05"
);

$newsArticle->set($article);

var_dump($newsArticle->articleData);

var_dump($newsArticle->save());

var_dump($newsArticle->articleData);
//var_dump($newsArticle);*/

/* $newsArticle->articleData['articleTitle'] = "Test Article 1a";
var_dump($newsArticle->save()); */

$articleList = $newsArticle->retrieveAll();
var_dump($articleList);
?>