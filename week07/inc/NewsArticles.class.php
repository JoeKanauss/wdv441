<?php

class NewsArticles
{
	//array to hold news article data
	var $articleData = array();
	
	//array to hold error messages
	var $errors = array();

	var $db = null;
	
	function __construct()
	{
		$this->db = new PDO('mysql:host=localhost; dbname=wdv441_2018; charset=utf8', 'wdv441', 'wdv441');
	}
	
	function set($dataArray)
	{
		//$this allows access to instance properties
		//set article data array to $dataArray
		$this->articleData = $dataArray;
	}
	
	function sanitize($dataArray)
	{
		//sanitize data based on rules
		$this->articleData["articleTitle"] = filter_var($dataArray["articleTitle"], FILTER_SANITIZE_STRING);
		$this->articleData["articleContent"] = filter_var($dataArray["articleContent"], FILTER_SANITIZE_STRING);
		$this->articleData["articleAuthor"] = filter_var($dataArray["articleAuthor"], FILTER_SANITIZE_STRING);
		$this->articleData["articleDate"] = filter_var($dataArray["articleDate"], FILTER_SANITIZE_STRING);
		
		
		
		return $dataArray;
	}
	
	function load($articleID)
	{
		//variable to check if successful load
		$isLoaded = false;
		
		//load from database
		$stmt = $this->db -> prepare("SELECT * FROM newsarticles WHERE articleID=?");
		$stmt -> execute(array($articleID));
		
		if($stmt->rowCount() == 1)
		{
			$dataArray = $stmt->fetch(PDO::FETCH_ASSOC);
			
			$this->set($dataArray);
			
			$isLoaded = true;
		}

		return $isLoaded;
	}
	
	function save()
	{
		//variable to check if successful save
		$isSaved = false;
		
		//determine if insert or update based on articleID
		if(empty($this->articleData['articleID']))
		{
			$stmt = $this->db->prepare("INSERT INTO newsarticles (articleTitle, articleContent, articleAuthor, articleDate) VALUES(?, ?, ?, ?)");
			$isSaved = $stmt->execute(array($this->articleData['articleTitle'], $this->articleData['articleContent'], $this->articleData['articleAuthor'], $this->articleData['articleDate']));
			
			if($isSaved)
			{
				$this->articleData['articleID'] = $this->db->lastInsertId();
			}
		}
		else
		{
			$stmt = $this->db->prepare("UPDATE newsarticles SET articleTitle = ?, articleContent = ?, articleAuthor = ?, articleDate = ? WHERE articleID = ?");
			$isSaved = $stmt->execute(array($this->articleData['articleTitle'], $this->articleData['articleContent'], $this->articleData['articleAuthor'], $this->articleData['articleDate'], $this->articleData['articleID']));
		}
		
		//save data from articleData property to database
		
		return $isSaved;
	}
	
	function validate()
	{
		//variable to check if successful validation
		$isValid = false;
		
		if(empty($this->articleData['articleTitle']))
		{
				$this->errors['articleTitle'] = "Please enter a title";
		}
		
		if(empty($this->articleData['articleContent']))
		{
				$this->errors['articleContent'] = "Please enter some content";
		}
		
		if(empty($this->articleData['articleAuthor']))
		{
				$this->errors['articleAuthor'] = "Please enter an author";
		}
		
		$date = $this->articleData['articleDate'];
		$year = substr($date, 0, 4);		
		$month = substr($date, 5, 2);		
		$day = substr($date, 8);
		
		if(empty($this->articleData['articleDate']))
		{
				$this->errors['articleDate'] = "Please enter a date";
		}
		else if(!checkdate($month, $day, $year))
		{			
			$this->errors['articleDate'] = "Please enter a valid date (yyyy-mm-dd)";
		}
		
		//validate data elements in articleData property
		//if an error exists, store to errors using column name as key
		
		
		var_dump($this->errors);
		  if(empty($this->errors))
		{
			$isValid = true;
		}
		
		return $isValid;
	}
	
	function retrieveAll($sortColumn = null, $sortDirection = null, $filterColumn = null, $filterText = null) //setting default values makes parameters optional
	{
		//retrieve all articles from data table
		//dipslay list of articles on web page
		//include edit link that uses add/edit page
		//include view link to go to view page 
		//inlcue link to add new article using add/edit page
		
		$sql = "SELECT * FROM newsarticles "; 
		
		if(!is_null($sortColumn))
		{
			$sql .= "ORDER BY ". $sortColumn;
			
			if(!is_null($sortDirection))
			{
				$sql .= " " . $sortDirection;
			}
		}
		
		if(!is_null($filterColumn) & !is_null($filterText))
		{
			$sql .= "WHERE ". $filterColumn . " LIKE ?";
		}
		
		$stmt = $this->db->prepare($sql);
		
			$stmt->execute(array("%".$filterText."%"));
			$list = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $list;
	}
	
}
?>