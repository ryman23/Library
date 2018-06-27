
<?php
	include_once '../header.php';
	global $userCardNumber;
	global $bookISBN;
?>

<!-- Checkout Book -->
<?php
	$bookISBN = 9780531213735;

	// Include connection to the DB
	include_once 'C:\xampp\htdocs\LoginSystemTest\Includes\dbh.inc.php';

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
		$pLname = "".$row["pLname"];
		$phone = "".$row["phone"];
		$email = "".$row["email"];
		echo $userCardNumber = $cardNumber;
    }
	echo "</table>";
	} 
	
	// checkout first available bookid copy
	
	// Query for first open copy
	$sql1 = "Select * from books where bookID NOT IN (Select bookID from borrowed)AND isbn = $bookISBN Limit 1";
	$result = $conn->query($sql1);

	if ($result->num_rows > 0) 
	{
    // output data of each row
    while($row = $result->fetch_assoc()) 
	{
       
		$bookID = "".$row["bookID"];
		
		echo "$bookID";
    }
	} 

	
	// checkout book
	
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


	// Insert query in borrowed table
	$sql = "INSERT INTO `borrowed`(`bookID`,`cardNumber`,`checkOutDate`,`dueDate`) VALUES ('$bookID','$userCardNumber','$currentDateTime','$year-$month-$day')";
	
	mysqli_query($conn, $sql);
	
	$str = $sql;
	echo "<br>$str";
	
	// SEND USER BACK TO MAIN BOOK PAGE AFTERING CHECKING OUT
	$newURL = "http://localhost/LoginSystemTest/books.php";
	header('Location: '.$newURL);
?>


