<?php
	// Include connection to the DB
	include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\Includes\dbh.inc.php");

	// Run SQL to find if the current user email has admin privileges.
	@$email = $_SESSION['u_email'];
	$sql = "SELECT * FROM patron WHERE email = '$email' AND isAdmin = 1";
	$results = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($results);
			
	if(isset($_SESSION['u_email']) AND $resultCheck > 0)
	{
		// If logged in as an admin, display admin sidebar.
		include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\sidebar_loggedin_admin.php");
	}
	else if(isset($_SESSION['u_email']))
	{
		include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\sidebar_loggedin.php");
	}
	else 
	{
		include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\sidebar_notloggedin.php");
	};
?>