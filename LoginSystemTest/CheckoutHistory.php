<!DOCTYPE html>
<?php
	include_once 'header.php';
?>
<html>
<head>
<style> 
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 105%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 2px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 5px;
    padding-bottom: 5px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
.flex-container {
    display: -webkit-flex;
    display: flex;  
    -webkit-flex-flow: row wrap;
    flex-flow: row wrap;
    text-align: center;
}
table, th, td {
    border: 1px solid black;
}
.flex-container > * {
    padding: 15px;
    -webkit-flex: 1 100%;
    flex: 1 100%;
}
h1 { font-size: 4em }
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

<h2>Checkout History Log </h2>
<p> This report shows the history of all materials checkedout </p>
<?php

//$sql = "Select * from returned";
	$sql ="Select returned.bookID, books.bookID, books.title,books.authorID,returned.cardNumber,returned.checkOutDate,returned.dueDate,returned.ReturnDate,returned.late
		FROM returned
		INNER join books on returned.bookID=books.bookID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo "<table id='customers'><tr><th>Title</th><th>bookID</th><th>Author</th><th>Card Number</th><th>CheckOut Date</th><th>dueDate</th><th>Return Date</th><th>late</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$title = "".$row["title"];
		$authorID="".$row["authorID"];
        $bookID = "" .$row["bookID"];
		$cardNumber = "".$row["cardNumber"];
		$checkOutDate = "".$row["checkOutDate"];
		$dueDate = "".$row["dueDate"];
		$ReturnDate = "".$row["ReturnDate"];
		$late = "__".$row["late"];
		
		echo "<tr><td>$title</td><td>$bookID</td><td>$authorID</td><td><b>$cardNumber</b></td><td>$checkOutDate</td><td>$dueDate</td><td>$ReturnDate</td><td><font color=red>$late</font></td></tr>";

    }
	echo "</table>";
} else {
    echo "No copies available";
}

?>
</article>
<br>
<footer>Sp18 CSCI 2050-90 - Riley Stephens</footer>
</div>
</body>
</html>


