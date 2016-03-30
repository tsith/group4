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
$con = connect('csmysql.cs.cf.ac.uk', 'group4.2015', 'A3bb6@4kmna', 'group4_2015');

$commonWords = 'and,the';

// GET USER INPUT VALUES & REMOVE COMMON WORDS
$title = removeCommonWords($commonWords, setVal('title'));
$author = removeCommonWords($commonWords, setVal('author'));
$publicationYear = removeCommonWords($commonWords, setVal('year'));
$publisher = removeCommonWords($commonWords, setVal('publisher'));
$citationsMin = removeCommonWords($commonWords, setVal('citationsMin'));
$citationsMax = removeCommonWords($commonWords, setVal('citationsMax'));

// GET SORT SELECTION VALUES
$sortSelection = setVal('sort');

// FUNCTION TO CHOOSE CORRECT QUERY AND SORT IF NECESSARY
$query = chooseQuery() . sortBy($sortSelection);
$keywords = keywordCount($title);

echo $query;
echo $keywords;

if( ( $query != null ))
{
  setcookie("Query", $title);
}
echo "Previous Search =  ". $_COOKIE['Query']."<BR>";

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
<table id = "suggestedTable" border ="2" style = "double" width = "20%">
<?php
$test = suggestedPapers($publisher);

$r1 = mysqli_query($con, $test, MYSQLI_STORE_RESULT)
    or die("Failed to connect: " . mysqli_error($con));

while($row = mysqli_fetch_array($r1)){
	echo "<tr>";
	echo "<td><br>".$row['Authors']."</td>";
	echo "<td>".$row['Title']."</td>";
    echo "<td><a href=".$row['ArticleURL'].">".$row['ArticleURL']."</a></td>";

}
?>
</html>
