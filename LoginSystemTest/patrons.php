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
table, th, td {
    border: 1px solid black;
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


<nav class="nav">

</nav>

<article class="article">

<!-- Load the sidebar -->
<?php
	include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\Includes\sideBarLogic.inc.php");
?>
<h1>Patron Records</h1>

<?php

// DB connection
include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\Includes\dbh.inc.php");

$sql = "SELECT patron.cardNumber,patron.pFname,patron.pLname,patron.email,patron.phone,patron.Fines,address.cardNumber,address.state,address.city,address.zip
FROM patron
INNER JOIN address ON patron.cardNumber = address.cardNumber;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo "<table id='customers'><tr><th>cardNumber</th><th>FirstName</th><th>LastName</th><th>Phone</th><th>City</th><th>State</th><th>Zip Code</th><th>email</th><th>Fines</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $cardNumber = "" .$row["cardNumber"];
		$pFname = "".$row["pFname"];
		$pLname = "".$row["pLname"];
		$phone = "".$row["phone"];
		$email = "".$row["email"];	
		$fines = "$".$row["Fines"];
		$state = "".$row["state"];
		$city = "".$row["city"];
		$zip = "".$row["zip"];
		echo "<tr><td>$cardNumber</td><td>$pFname</td><td>$pLname</td><td>$phone</td><td>$city</td><td>$state</td><td>$zip</td><td>$email</td><td>$fines</td></tr>";
    }
	echo "</table>";
} else {
    echo "No Patrons";
}

?>
</article>
<footer>Sp18 CSCI 2050-90 - Riley Stephens</footer>
</div>
</body>
</html>


