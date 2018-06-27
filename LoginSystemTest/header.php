<?php

session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Library</title>
	<img src="HomePageIcon.png" align="left";">
	<link rel="stylesheet" type="text/css" href="style.css">
	<img src="HomePageIcon.png" align="right";">
	
</head>
<body>

<header>

	<nav>
	
		<div class="main-wrapper">
			<div class="nav-login">
				
				<?php
					
					if(isset($_SESSION['u_email'])){
						echo '<form action="includes/logout.inc.php" method="POST">
								<button type="submit" name="submit">Logout</button>
							</form>';
					} else {
						echo '<form action="includes/login.inc.php" method="POST">	
								<input type="text" name="email" placeholder="Email">
								<input type="text" name="password" placeholder="Password">
								<button type="sumbit" name="submit">Login</button>
								</form>
								<a href="signup.php">Sign Up</a>';
					}
				?>
			</div>
		</div>
	</nav>
</header>