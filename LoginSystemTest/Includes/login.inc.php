<?php

session_start();

if(isset($_POST['submit'])){
	
	include 'dbh.inc.php';
	
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	
	//Check if inputs are empty
	if(empty($email) || empty($password)){
		header("Location: ../index.php?login=empty");
		exit();
	} else {
			$sql = "SELECT * FROM patron WHERE email ='$email'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			
			if($resultCheck < 1){
				header("Location: ../index.php?login=error");
				exit();
			} else {
				if($row = mysqli_fetch_assoc($result)){
					//Dehashing the password
					$hashedPasswordCheck = password_verify($password, $row['password']);
					if($hashedPasswordCheck == false){
						header("Location: ../index.php?login=error");
						exit();
					} elseif($hashedPasswordCheck == true) {
						//Login the user
						$_SESSION['u_email'] = $row['email'];
						$_SESSION['u_first'] = $row['first'];
						$_SESSION['u_last'] = $row['last'];
						header("Location: ../index.php?login=success");
						exit();
					}
				}
			}
		}
	
} else {
	header("Location: ../index.php?login=error");
	exit();
}