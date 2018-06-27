<?php
	include_once 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
<style> 
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
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
.flex-container > * {
    padding: 15px;
    -webkit-flex: 1 100%;
    flex: 1 100%;
}
.article {
    text-align: left;
}
h1 { font-size: 4em }
h2 { font-size: 3em }
h3 { font-size: 2em }
header {background: MediumSeaGreen;color:white;}
footer {background: #aaa;color:white;}
.nav {background:#eee;}
table, th, td {
    border: 1px solid black;
}
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

<h2>Items Not Checked Out Log </h2>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library1";

	// Include connection to the DB
	include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\Includes\dbh.inc.php");


$sql = "Select *
from books
where bookID NOT IN (Select bookID from borrowed);";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo "<table id='customers'><tr><th>title</th><th>isbn</th><th>authorID</th><th>bookID</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $title = "" .$row["title"];
		$isbn = "".$row["isbn"];
		$authorID = "".$row["authorID"];
		$quantity = "".$row["quantity"];
		$bookID = "".$row["bookID"];	
		echo "<tr><td>$title</td><td>$isbn</td><td>$authorID</td><td>$bookID</td></tr>";
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


