<?php 
	global $bookISBN;
	global $imgPath;
	global $notloggedIn;
 ?>

<html>
<!-- Local Style -->
<style> 
<head>

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
    text-align: left;
	padding-left: 9em;
}

.flex-container > * {
    padding: 1px;
    -webkit-flex: 1 100%;
    flex: 1 100%;
	padding-left: 4em;

}

.article {
    text-align: middle;
	padding-left: 4em;
}

.top
{
	background: MediumSeaGreen;color:blue;
	h1 { font-size: 4em }
}

headerT {background: MediumSeaGreen;color:blue;}
footer {background: #aaa;color:white;}

h1 { font-size: 4em }
h2 { font-size: 3em }
h3 { font-size: 2em }
@media all and (min-width: 768px) {
   
    .article {-webkit-flex:5 0px;flex:5 0px;-webkit-order:2;order:2;}
    footer {-webkit-order:3;order:3;}
}

input[type=button], input[type=submit], input[type=reset] {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 8px 16px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}

</style>
</head>
<body>

<div class="flex-container">

<article class="article">
<?php
	include_once 'header.php';
?>



<!-- Load the sidebar -->
<?php
	include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\Includes\sideBarLogic.inc.php");
?>

<section class="main-container">
	<div class="main-wrapper">
			<img src="<?php echo $imgPath ?>" alt="<?php echo $imgPath ?>" style="width:300px;height:350px;" align="right">
	</div>
</section>

<font size =10> Book Info </font><BR><BR>

<!-- Book Info -->
<?php
	include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\Includes\dbh.inc.php");
	//include_once 'C:\xampp\htdocs\LoginSystemTest\Includes\dbh.inc.php';

	//Query book info
	//$sql = "SELECT books.authorID,author.authorID, author.afname, books.isbn, author.alname,books.title,books.quantity,books.bookID
	$sql = "SELECT books.authorID,author.authorID, author.afname, books.isbn, author.alname,books.title,books.quantity,books.bookID
FROM books
INNER JOIN author
ON books.authorID = author.authorID WHERE books.isbn = $bookISBN
GROUP BY author.alname";


	$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $title = "Title: " .$row["title"];
		$isbn = "ISBN: ".$row["isbn"];
		$authorID = "Authord ID: ".$row["authorID"];
		$quantity = "Copies: ".$row["quantity"];
		$bookID = "Book ID: ".$row["bookID"];
	    $authorFname = "".$row["afname"];
		$authorLname = "".$row["alname"];
		
		// FROMAT OUTPUT
		echo "<b><BR><font size=5>$title</b><br>$isbn<br>Author: $authorLname,$authorFname<br>$authorID<br>$quantity</font><br>-------------------------------<br>";
    }
} else {
    echo "<h3 style=color:red;>No available copies</h3>";
}
?>

<BR><BR><BR><font size =10> Copies Available </font><BR><BR>

<?php
	//include_once 'C:\xampp\htdocs\LoginSystemTest\Includes\dbh.inc.php';
	include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\Includes\dbh.inc.php");
	//include $_SERVER['DOCUMENT_ROOT']."\LoginSystem\Includes\dbh.inc.php";
	
/// Available copies query
$sql = "Select * from books where bookID NOT IN (Select bookID from borrowed)AND isbn = $bookISBN";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $title = "" .$row["title"];
		$isbn = "ISBN: ".$row["isbn"];
		$authorID = "Authord ID: ".$row["authorID"];
		$quantity = "Copies: ".$row["quantity"];
		$bookID = "Book ID: ".$row["bookID"];
		
		// Not logged in - don't allow book checkout
		if($notloggedIn==true)
		{
			echo "<b><U>$title</b></U><br>$isbn<br>$authorID<br>$quantity<br>$bookID<br>
			<br> ";
		}
		// Logged in - allow book checkout
		else
		{
			// Assign CardNumber
			$currentUserEmail = $_SESSION['u_email'];
			$sql = "Select * from patron where email ='$currentUserEmail'";
			$resulta = $conn->query($sql);

			if ($result->num_rows > 0) 
			{
				"<table><tr><th>cardNumber</th><th>FirstName</th><th>LastName</th><th>Phone</th><th></th><th>email</th></tr>";
				// output data of each row
				while($row = $resulta->fetch_assoc()) 
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
			
			//---------------------------------------------------
			// check if cardID in borrowed > 5;
			$sql1 = "SELECT COUNT(*) FROM borrowed where cardNumber = $userCardNumber";
			$result1 = mysqli_query($conn,$sql1);
			$out = mysqli_fetch_array($result1);	
			$booksOut = $out[0];
			//---------------------------------------------------
			
			// Displays all copies 
			if($booksOut<5)
			{
				echo "<b><U>$title</b></U><br>$isbn<br>$authorID<br>$quantity<br>$bookID<br>
				<form action=book/$bookISBN.php method=post>
				<input type=submit name=someAction value=Checkout>
				</form><br><br> ";
				
			}else  echo "<h3 style=color:red;>LIMIT REACHED</h3>";
		}
    }
} else {
    echo "<h3 style=color:red;>No available copies</h3>";
}
$conn->close();
?>
<?php
	include_once 'footer.php';
?>
<a href="Books.php"><img src="/LoginSystemTest/back.png" align="LEFT";"></a>
</article>
<footer>Sp18 CSCI 2050-90 - Aaron, Lydia, Riley</footer>
</div>
</body>
</html>
