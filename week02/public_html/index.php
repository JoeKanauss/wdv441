<?php

$validForm = true;

//messages and input values initially empty to present a clean, empty form on first viewing
$firstNameError = "";
$lastNameError = "";
$dateOfBirthError = "";
$emailAddressError = "";
$messageError = "";
$confirm = "";

$inFirstName = "";
$inLastName = "";
$inDateOfBirth = "";
$inEmailAddress = "";
$inMessage = "";

function validateFirstName($firstNameToValidate)
{
	global $validForm, $firstNameError;
	
	$firstNameRegEx = "/^[a-zA-Z'\- ]*$/";
	$sanitizedFirstName = filter_var($firstNameToValidate, FILTER_SANITIZE_STRING);

	if(!preg_match($firstNameRegEx, $firstNameToValidate))
	{
			$firstNameError = "Please a valid first name (only letters, apostrophes, and hyphens allowed)";
			
			$validForm = false;
	}
	else if($firstNameToValidate == "")
	{
			$firstNameError =  "Please enter a valid first name"; 
			
			$validForm = false;
	}
	
	
	
}

function validateLastName($lastNameToValidate)
{
	global $validForm, $lastNameError;

	$lastNameRegEx = "/^[a-zA-Z'\- ]*$/";
	$sanitizedLastName = filter_var($lastNameToValidate, FILTER_SANITIZE_STRING);
	
	if(!preg_match($lastNameRegEx, $sanitizedLastName))
	{
			$lastNameError = "Please a valid first name (only letters, apostrophes, and hyphens allowed)"; 
			
			$validForm = false;
	}
	else if($sanitizedLastName == "")
	{
			$lastNameError = "Please enter a valid last name"; 
			
			$validForm = false;
	}
	
	
}

function validateDateOfBirth($dateOfBirthToValidate)
{
	global $validForm, $dateOfBirthError;
	
	$parsedDate = date_parse($dateOfBirthToValidate);
	
	if(!checkdate($parsedDate['month'], $parsedDate['day'], $parsedDate['year']))
	{
			$dateOfBirthError = "Please enter a valid date of birth (mm/dd/yyyy)"; 
			
			$validForm = false;
	}
	else if($dateOfBirthToValidate == "")
	{
			$dateOfBirthError = "Please enter a valid date of birth"; 
			
			$validForm = false;
	}
	

}

function validateEmailAddress($emailAddressToValidate)
{
	global $validForm, $emailAddressError;
	
	$validEmail = filter_var($emailAddressToValidate, FILTER_VALIDATE_EMAIL);
	if(!$validEmail)
	{
			$emailAddressError =  "Please enter a valid email address"; 
			
			$validForm = false;
	}
	else if($emailAddressToValidate == "")
	{
			$emailAddressError = "Please enter a valid email address"; 
			
			$validForm = false;
	}
	
	
}

function validateMessage($messageToValidate)
{
	global $validForm, $messageError;
	
	$messageRegEx = "/[a-zA-Z0-9,.!?;\'\" ]$/";
	$sanitizedMessage = filter_var($messageToValidate, FILTER_SANITIZE_STRING);
	
	if(!preg_match($messageRegEx, $sanitizedMessage))
	{
			$messageError =  "Please enter a valid message (letters, numbers, and basic punctuation only)"; 
			
			$validForm = false;
	}
	else if($messageToValidate == "")
	{
			$messageError =  "Please enter a valid message"; 
			
			$validForm = false;
	}
	
	
}

if(isset($_POST["submitContactForm"]))
{
	
	
	$inFirstName = $_POST["firstName"];
	$inLastName = $_POST["lastName"];
	$inDateOfBirth = $_POST["dateOfBirth"];
	$inEmailAddress = $_POST["emailAddress"];
	$inMessage = $_POST["message"];
	
	validateFirstName($inFirstName);
	validateLastName($inLastName);
	validateDateOfBirth($inDateOfBirth);
	validateEmailAddress($inEmailAddress);
	validateMessage($inMessage);

	if($validForm)
	{
		
		$to = "gbgrandberg@dmacc.edu";
		$from = "from: web@joekanauss.info";
		$subject = "WDV441 Week02 Contact Form";
		$message = "WDV441 Week02 Contact Form \r\nFirst Name:  $inFirstName\r\nLast Name: $inLastName\r\nDate of Birth: $inDateOfBirth\r\nEmailAddress: $inEmailAddress\r\nMessage: $inMessage";
		
		if(mail($to, $subject, $message, $from))
		{
				$confirm = "[[Contact form has been emailed! ]]";
		}
		else
		{
			$confirm =  "[[ Contact form could not be emailed. Please try again later. ]]";
		}

	}
	else
	{
		$confirm =  "[[ Contact form cannot be confirmed ]]";
	}
}


?>

<html>
	<head>
		<title>WDV441 Contact Form</title>
		<style>
			body{
				background-color: #ccddff;
			}
			form{
				margin: auto;
				width: 50%;
				border: 5px solid #80aaff;
				background-color: 	#e5ffe5;
				text-align: center;
			}
			.error{
				font-style: italic;
				color: red;
			}
			input[type=text]{
				background-color: #ffffe5;
			}
			textarea{
				background-color: #ffffe5;
			}
			
			.confirm{
				font-size: 1.25em;
				font-weight: bold;
			}
		</style>
	</head>
	
	<body>
		<form id="contactForm" name="contactForm" method="post" action="index.php">
		<p>First Name: <input type="text" name="firstName" value="<?php echo $inFirstName; ?>"/> <span class="error"><?php echo $firstNameError;?></span></p>
		<p>Last Name: <input type="text" name="lastName"  value="<?php echo $inLastName; ?>"/> <span class="error"><?php echo $lastNameError;?></span></p>
		<p>Date of Birth (mm/dd/yyyy): <input type="text" name="dateOfBirth" value="<?php echo $inDateOfBirth; ?>"/> <span class="error"><?php echo $dateOfBirthError;?></span></p>
		<p>Email Address: <input type="text" name="emailAddress" value="<?php echo $inEmailAddress; ?>"/> <span class="error"><?php echo $emailAddressError;?></span></p>
		<p>Message  <span class="error"><?php echo $messageError;?></span><br>
		<textarea name="message" cols="40" rows="10"><?php echo $inMessage; ?></textarea></p>
		<p><input type="submit" name="submitContactForm" value="Submit Form" /> <input type="reset" value="Reset Form" /></p>
		<p class="confirm"><?php echo $confirm; ?></p>
		</form>
	</body>
</html>
	