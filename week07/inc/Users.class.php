<?php

class Users
{
	//array to hold user data
	var $userData = array();
	
	//array to hold errors
	var $errors = array();
	
	//set an empty database variable
	var $db = null;
	
	
	
	//create a construct function that will set the database when a new user class is created
	function __construct()
	{
		$this->db = new PDO('mysql:host=localhost; dbname=wdv441_2018; charset=utf8', 'wdv441', 'wdv441');
	}
	
	function set($dataArray)
	{
		//allows access to instance properties
		$this->userData = $dataArray;
	}
	
	function sanitize($dataArray)
	{
		//sanitize data based on rules
		$this->userData["username"] = filter_var($dataArray["username"], FILTER_SANITIZE_STRING);
		$this->userData["password"] = filter_var($dataArray["password"], FILTER_SANITIZE_STRING);
		
		if(isset($this->userData['user_level']))
		{
			$this->userData["user_level"] = filter_var($dataArray["user_level"], FILTER_SANITIZE_STRING);
		}
		return $dataArray;
	}
	
	function load($userId)
	{
		//variable to check if successful load
		$isLoaded = false;
		
		//load from database
		$stmt = $this->db -> prepare("SELECT * FROM user WHERE user_id=?");
		$stmt -> execute(array($userId));
		
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
		if(empty($this->userData['user_id']))
		{
			$stmt = $this->db->prepare("INSERT INTO user (username, password, user_level) VALUES(?, ?, ?)");
			
			$isSaved = $stmt->execute(array($this->userData['username'], $this->userData['password'], $this->userData['user_level']));
			
			if($isSaved)
			{
				$this->userData['user_id'] = $this->db->lastInsertId();
			}
		}
		else
		{
			$stmt = $this->db->prepare("UPDATE user SET username = ?, password = ?, user_level = ? WHERE user_id = ?");
			
			$isSaved = $stmt->execute(array($this->userData['username'], $this->userData['password'], $this->userData['user_level'], $this->userData['user_id']));
		}
		
		//save data from userdata property to database
		
		return $isSaved;
	}
	
	function validate()
	{
		//variable to check if successful validation
		$isValid = false;
		
		if(empty($this->userData['username']))
		{
				$this->errors['username'] = "Please enter a Username";
		}
		
		if(empty($this->userData['password']))
		{
				$this->errors['password'] = "Please enter a password";
		}
		
		if(empty($this->userData['user_level']))
		{
				$this->errors['user_level'] = "Please enter a user level";
		}
		
		
		//validate data elements in userData property
		//if an error exists, store to errors using column name as key
		
		  if(empty($this->errors))
		{
			$isValid = true;
		}
		
		return $isValid;
	}
	
	
	// function to see if the username and password match up
	function checkLogin($username, $password)
	{
		
		//set an empty userId variable
		$userId = null;
		
		//make a call to grab the user id of the row that has a username AND password that match the specified ones
		$stmt = $this->db -> prepare("SELECT user_id FROM user WHERE username=? && password=?");
		
		$stmt -> execute(array($username, $password));
		
		$userIdToCheck = $stmt->fetch(PDO::FETCH_ASSOC);
		
		//var_dump($userIdToCheck);
		
		
		//if the username and password do not match up, no rows will be found, and userIdToCheck will equal false
		//if username and password do not match up, put out error
		if($userIdToCheck == false)
		{
			$this->errors['password'] = "Username and password do not match";
			
			//var_dump($password, $userIdToCheck);
			//echo "NOOOO!!!";
		}
		//else, if the username and password do match up, set the user id to the $userId variable
		 else
		{
			$userIdToCheck = $userIdToCheck['user_id'];
		} 
		
		//return the user ID associated with the username and password
		return $userIdToCheck;
	}
	
	
	
}


?>