<html lang ="en">
<head>
	<title>Group 4 SPMIS</title>
	<meta charset = "utf-8" /><!--sets the character encoding for unicode-->
	<link rel='stylesheet' type ='text/css' href='style.css'/><!--links to my style sheet-->
	<link rel='stylesheet' type ='text/css' href= 'foundation.css'/>
	<body>
		<table id = "mainTable" border ="1" style = "double" width = "60%">

<?php

include "functions.php";
$con = connect('csmysql.cs.cf.ac.uk', 'c1433846', 'udruc3', 'c1433846');

$commonWords = 'and,the';

$title = removeCommonWords($commonWords, setVal('title'));
$author = removeCommonWords($commonWords, setVal('author'));
$publicationYear = removeCommonWords($commonWords, setVal('year'));
$citationsMin = removeCommonWords($commonWords, setVal('citationsMin'));
$citationsMax = removeCommonWords($commonWords, setVal('citationsMax'));

$query = chooseQuery();

//echo $query;

$r = mysqli_query($con, $query, MYSQLI_STORE_RESULT)
    or die("Failed to connect: " . mysqli_error($con));

while($row = mysqli_fetch_array($r)){
	echo "<tr>";
	echo "<td><br>".$row['Authors']."</td>";
	echo "<td>".$row['Title']."</td>";
    echo "<td><a href=".$row['ArticleURL'].">".$row['ArticleURL']."</a></td>";
}

closeConnection($con);

?>
</html>
