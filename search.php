<html lang ="en">
<head>
	<title>Group 4 SPMIS</title>
	<meta charset = "utf-8" /><!--sets the character encoding for unicode-->
	<link rel='stylesheet' type ='text/css' href='mockStyle.css'/><!--links to my style sheet-->

	<body>
		<table id = "mainTable" border ="1" style = "double" width = "60%">

<?php
include 'MainPage.php';
include 'chooseQuery.php';

$query = "";
$con = mysqli_connect("csmysql.cs.cf.ac.uk", "c1416357", "efkiv6", "c1416357");
//connects the database using my credentials. if it does not connect it "dies"
//and displays an error
if (!$con){
	die("Failed to connect: " .mysqli_connect_error());
}


// chooseQuery() should be used here & the following $query definition removed.

$query = "SELECT * FROM CompSci";
$r = mysqli_query($con, $query);
while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
	echo "<tr>";
	echo "<td><br>".$row['Authors']."</td>";
	echo "<td>".$row['Title']."</td>";
}


mysqli_close($con);  

?>


