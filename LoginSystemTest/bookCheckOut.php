
<?php
	include_once 'header.php';
	global $userCardNumber;
	global $patronName;
?>

<!DOCTYPE html>
<html>
<head>
<style> 
input[type=button], input[type=submit], input[type=reset] {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 8px 16px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}

.flex-container {
    display: -webkit-flex;
    display: flex;  
    -webkit-flex-flow: row wrap;
    flex-flow: row wrap;
    text-align: center;
}

.flex-container > * {
    padding: 15px;
    -webkit-flex: 1 100%;
    flex: 1 100%;
}

.article {
    text-align: left;
}
h1 { font-size: 4em }
h3 { font-size: 2em }
header {background: MediumSeaGreen;color:white;}
footer {background: #aaa;color:white;}
.nav {background:#eee;}

.nav ul {
    list-style-type: none;
    padding: 0;
}
.nav ul a {
    text-decoration: none;
}

@media all and (min-width: 768px) {
    .nav {text-align:left;-webkit-flex: 1 auto;flex:1 auto;-webkit-order:1;order:1;}
    .article {-webkit-flex:5 0px;flex:5 0px;-webkit-order:2;order:2;}
    footer {-webkit-order:3;order:3;}
}
</style>
</head>
<body>

<div class="flex-container">


<nav class="nav">

</nav>

<article class="article">
<!-- Load the sidebar -->
<?php
	include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\Includes\sideBarLogic.inc.php");
?>


  <h3>Check out a book </h3>

<form action = "bookCheckOut.php" method = "post">
BookID: <input type = "number" name = "bookID"><br /> 
<input type = "submit" name = "submit">
<input type = "submit" name = "goBack" value = "Return to Main Menu">
</form>
<?php
if(isset($_POST['submit']))
{
	// Include connection to the DB
	include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\Includes\dbh.inc.php");
	
	if(!$conn)
	{	
		die("Cannot connect to the database");
	}

	if(empty($_POST["bookID"]))
	{
		echo "ENTER bookID";
	} 
	
	// Book id is enter do this
	else
	{
		
		$bookID=$_POST['bookID'];

		// Assign CardNumber
		$currentUserEmail = $_SESSION['u_email'];

		$sql = "Select * from patron where email ='$currentUserEmail'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			"<table bgcolor=ebeaea><tr><th>cardNumber</th><th>FirstName</th><th>LastName</th><th>Phone</th><th></th><th>email</th></tr>";
			// output data of each row
			while($row = $result->fetch_assoc()) 
				{
				$cardNumber = "" .$row["cardNumber"];
				$pFname = "".$row["pFname"];
				$patronName = $pFname;
				$pLname = "".$row["pLname"];
				$phone = "".$row["phone"];
				$email = "".$row["email"];
				$userCardNumber = $cardNumber;
				"<tr><td>$cardNumber</td><td>$pFname</td><td>$pLname<td><td>$phone</td><td>$email</td></tr>";
				}
			echo "</table>";
	
		} 
		else 
		{
			echo "No Patrons";
		}

	
		// automatic today
		$currentDateTime = date('Y-m-d');
	
		// Due Date
		$dueDate=strtotime($currentDateTime);
		$dueDate=date('Y-m-d',$dueDate);
	
		$dueDate = $currentDateTime;
		$dateDue = date("Y-m-d",strtotime($dueDate));
	
		//One week later
		$oneWeekLater = strtotime('+2 Week');
		$year = date('Y', $oneWeekLater);
		$month = date('m', $oneWeekLater);
		$day = date('d', $oneWeekLater);

		//---------------------------------------------------
		// check if cardID in borrowed > 5;
		$sql = "SELECT COUNT(*) FROM borrowed where cardNumber = $userCardNumber";

		$result = mysqli_query($conn,$sql);
		$out = mysqli_fetch_array($result);
		echo "<BR>Books Currently Checked Out:"; 
		$booksOut = $out[0];
		echo "<b>$booksOut</b> to $patronName<br>";
		//---------------------------------------------------
	
		
		if($booksOut<5)
		{
			// Insert query
			$sql = "INSERT INTO `borrowed`(`bookID`,`cardNumber`,`checkOutDate`,`dueDate`) VALUES ('$bookID','$userCardNumber','$currentDateTime','$year-$month-$day')";
	
			// Manual card entry
			//	VALUES 	('$bookID','$userCardNumber','$currentDateTime','$dateDue')";
	
			mysqli_query($conn, $sql);
	
			$str = $sql;
			echo "Books checked out";
			//echo $str;    // this will echo the query;
		}
		// Patron has reached the checkout limit
		else
		{	
			echo "<Br><h3 style=color:red>MAX LIMIT 5</h3>";
		}
	
	}
}
?>
</article>
<footer>Sp18 CSCI 2050-90 - Aaron, Lydia, Riley</footer>
</div>
</body>
</html>


