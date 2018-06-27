<?php

if(isset($_POST['submit']))
{
	include_once 'dbh.inc.php';
	
	$first = mysqli_real_escape_string($conn, $_POST['first']);
	$last = mysqli_real_escape_string($conn, $_POST['last']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$street = mysqli_real_escape_string($conn, $_POST['street']);
	$city = mysqli_real_escape_string($conn, $_POST['city']);
	$state = mysqli_real_escape_string($conn, $_POST['state']);
	$zip = mysqli_real_escape_string($conn, $_POST['zip']);
	$cc = mysqli_real_escape_string($conn, $_POST['cc']);
	
	//Error Handlers
	//Empty Field Handler
	if(empty($first) || empty($last) || empty($phone) || empty($email) || empty($password) || empty($street) || empty($city) || empty($zip) || empty($cc))
	{
		header("Location: ../signup.php?signup=empty");
		exit();
	} else {
			//Check if input chars are valid
			if(!preg_match("/^[a-zA-Z ]*$/", $first) || !preg_match("/^[a-zA-Z ]*$/", $last) || !preg_match("/^[0-9]*$/", $phone) || !preg_match("/^[a-zA-Z ]*$/", $city) || !preg_match("/^[a-zA-Z]*$/", $state) || !preg_match("/^[0-9]*$/", $zip) || !preg_match("/^[0-9]*$/", $cc)) 
			{
				header("Location: ../signup.php?signup=invalid");
				exit();
			} else {
						//Check if email is valid
						if(!filter_var($email, FILTER_VALIDATE_EMAIL))
						{
						header("Location: ../signup.php?signup=invalidemail");
						exit();
						} else {
								$sql = "SELECT * FROM patron WHERE email='$email'";
								$results = mysqli_query($conn, $sql);
								$resultCheck = mysqli_num_rows($result);

								if($resultCheck > 0)
								{
									header("Location: ../signup.php?signup=emailalreadyinuse");
									exit();
								} else {
										//Hashing the password
										$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
										//Insert the user into the DB
										$sql2 = "INSERT INTO patron(pFname,pLname,phone, email, password) VALUES ('$first', '$last', '$phone', '$email', '$hashedPassword')";
										mysqli_query($conn, $sql2);
	
										$sql3 = "INSERT INTO creditcards(creditCard,pFname,pLname) Values ('$cc', '$first', '$last')";
										mysqli_query($conn, $sql3);
	
										$sql4 = "UPDATE creditcards C, patron P SET C.cardNumber = P.cardNumber WHERE C.pFname = P.pFname AND C.pLname = P.pLname";
										mysqli_query($conn, $sql4);
	
										$sql5 = "INSERT INTO address(state,city,zip,pLname,pFname) Values ('$state', '$city', '$zip', '$first', '$last')";
										mysqli_query($conn, $sql5);
	
										$sql6 = "UPDATE address A, patron P SET A.cardNumber = P.cardNumber WHERE A.pFname = P.pFname AND A.pLname = P.pLname";
										mysqli_query($conn, $sql6);
										header("Location: ../signup.php?signup=success");
										exit();
										}
						}
				}
	}
} 
else
{
	header("Location: ../signup.php");
	exit();
}