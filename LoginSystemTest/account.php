<!DOCTYPE html>
<?php
	include_once 'header.php';
	global $userCardNumber;
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

.flex-container > * {
    padding: 15px;
    -webkit-flex: 1 100%;
    flex: 1 100%;
}

.article {
    text-align: left;
}
table, th, td {
    border: 1px solid black;
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

h1 { font-size: 4em }
h2 { font-size: 3em }
h3 { font-size: 2em }

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

<h1>Patron Record</h1>

<H3>for <?php echo $_SESSION['u_email'] ?></h3>

<?php



$currentUserEmail = $_SESSION['u_email'];

$sql = "Select * from patron where email ='$currentUserEmail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo "<table id='customers'><tr><th>Card Number</th><th>First Name</th><th>Last Name</th><th>Phone#</th><th>email</th><th>Fines</td></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $cardNumber = "" .$row["cardNumber"];
		$pFname = "".$row["pFname"];
		$pLname = "".$row["pLname"];
		$phone = "".$row["phone"];
		$email = "".$row["email"];
		$fines = "$".$row["Fines"];
		$userCardNumber = $cardNumber;
		echo "<tr><td>$cardNumber</td><td>$pFname</td><td>$pLname</td><td>$phone</td><td>$email</td><td>$fines</td></tr>";
    }
	echo "</table>";
} else {
    echo "No Patrons";
}

?>
<Br>
<H2>Book's checkedout </H2>
Limit 5
<?php
$sql = "Select *
from borrowed
where cardNumber = $userCardNumber";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo "<table id='customers'><tr><th>Book ID</th><th>Checkout Date</th><th>Due Date</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $bookID = "" .$row["bookID"];
		$checkOutDate = "".$row["checkOutDate"];
		$dueDate = "".$row["dueDate"];
		
		echo "<tr><td>$bookID</td><td>$checkOutDate</td><td>$dueDate</td></tr>";
    }
	echo "</table>";
} else {
    echo "No items checkedout";
}
?>

<?php
	include_once 'footer.php';
?>
</article>
<footer>Sp18 CSCI 2050-90 - Riley Stephens</footer>
</div>
</body>
</html>


