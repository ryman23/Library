<!DOCTYPE html>
<?php
	include_once 'header.php';
	global $lastAuthorID;
?>
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
h1 { font-size: 4em }
h2 { font-size: 3em }
h3 { font-size: 2em }
.flex-container > * {
    padding: 15px;
    -webkit-flex: 1 100%;
    flex: 1 100%;
}

.article {
    text-align: left;
}

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
<header>
  
  <img src="/librarySite/HomePageIcon.png" align="left";">
  <img src="/librarySite/HomePageIcon.png" align="right";">
  <h1>Add Library Book</h1>

</header>

<nav class="nav">

</nav>

<article class="article">

<!-- Load the sidebar -->
		<?php
			include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\Includes\sideBarLogic.inc.php");
		?>

  <P> First add in the author info and click submit, an <b>authorID</b> will be generated, which is needed for the Book Info. 
  <br><br><h3>Author Info</h3>
<form action = "addBook.php" method = "post">
Author First Name: <input type = "text" name = "afname"><br />
Author Last Name: <input type = "text" name = "alname"><br />
<input type = "submit" name = "submit" value = "Add">
<input type = "submit" name = "goBack" value = "Clear">
</form>
<!-- Add Author -->
<?php
if(isset($_POST['submit']))
{
	include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\Includes\dbh.inc.php");

	$sql = "INSERT INTO author(afname,alname) 
		VALUES 
		('$_POST[afname]', '$_POST[alname]')";
		
	mysqli_query($conn, $sql);
	
	// ECHO LAST AUTHOR ID
	$sql2 = "SELECT * FROM author ORDER BY authorID DESC LIMIT 1";
	$results = mysqli_query($conn, $sql2);
	while ($row = $results->fetch_assoc()) 
	{
		echo "Successfully added '$_POST[afname]' Author ID is ";
		$lastAuthorID =$row['authorID'];
		echo $row['authorID'];
		
	}
}
?>

<BR><br><h3>Book Info</h3>
<form action = "addBook.php" method = "post">
ISBN: <input type = "integer" name = "isbn"><br />
Title: <input type = "text" name = "title"><br />
AuthorID: <input type = "integer" name = "authorID" value = <?php echo $lastAuthorID;?>><br/>
Quantity: <input type = "number" name = "quantity" min="1"><br />
<input type = "submit" name = "submit1" value = "Add">
<input type = "submit" name = "goBack" value = "Clear">
</form>

<?php
if(isset($_POST['submit1']))
{
	include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\Includes\dbh.inc.php");

	// Assign to from to constant variable
	$copies = $_POST['quantity'];

	// Check if Quantity is greater than 1
	if($copies>1)
	{
		// Loop through the amount of copies
		for ($x = 0; $x < $copies; $x++)
		{
			// Add each book
			$sql = "INSERT INTO books(isbn,title,authorID,quantity) 
			VALUES 
			('$_POST[isbn]', '$_POST[title]','$_POST[authorID]','$_POST[quantity]')";
			mysqli_query($conn, $sql);
		}
		// Display 
		echo "Successfully added $copies copies of '$_POST[title]'";
	}
	else // Add only one copy
	{
		// add book
		$sql = "INSERT INTO books(isbn,title,authorID,quantity) 
		VALUES 
		('$_POST[isbn]', '$_POST[title]','$_POST[authorID]','$_POST[quantity]')";
		mysqli_query($conn, $sql);
		// Display
		echo "Successfully added '$_POST[title]'!"; 
	}
}
?>
<br>
</article>
<footer>Sp18 CSCI 2050-90 - Riley Stephens</footer>
</div>
</body>
</html>


