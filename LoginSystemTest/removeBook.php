<!DOCTYPE html>
<?php
	include_once 'header.php';
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

.flex-container > * {
    padding: 15px;
    -webkit-flex: 1 100%;
    flex: 1 100%;
}
h1 { font-size: 4em }
h2 { font-size: 3em }
h3 { font-size: 2em }
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
  <img src="/LoginSystemTest/HomePageIcon.png" align="left";">
  <img src="/LoginSystemTest/HomePageIcon.png" align="right";">
  <h1>Library</h1>
</header>

<nav class="nav">
</nav>

<article class="article">
<!-- Load the sidebar -->
<?php
	include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\Includes\sideBarLogic.inc.php");
?>
  <h1>Remove Book</h1>
  <BR>
<form action = "removeBook.php" method = "post">
BookID: <input type = "number" name = "bookID"><br>
<input type = "submit" name = "submit">
<input type = "submit" name = "goBack" value = "Clear">
</form>
<br><br>


<?php

if(isset($_POST['submit']))
{
	// Include connection to the DB
	include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\Includes\dbh.inc.php");
	$bookID = '$_POST[bookID]';

	// New Query
	$sql="DELETE FROM books WHERE bookID='$_POST[bookID]';";

	$sql2 = "DELETE FROM borrowed WHERE bookID='$_POST[bookID]';";
	
	mysqli_query($conn, $sql);
	mysqli_query($conn, $sql2);
	echo "Deleted bookID: '$_POST[bookID]'";

}

?>
<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
</article>

<footer>Sp18 CSCI 2050-90 - Riley Stephens</footer>
</div>
</body>
</html>


