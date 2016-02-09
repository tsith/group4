<?php function chooseQuery(){
    $query = "";
    if (!empty($_POST['name'])) $author = $_POST['name'];
    if (!empty($_POST['title'])) $title = $_POST['title'];
    if (!empty($_POST['keywords'])) $keywords = $_POST['keywords'];
    if (!empty($_POST['Year'])) $publicationYear = $_POST['Year'];
    if (!empty($_POST['citationsMin'])) $citationsMin = $_POST['citationsMin'];
    if (!empty($_POST['citationsMax'])) $citationsMax = $_POST['citationsMax'];

    // USE MAIN SEARCH (TITLE)
    if (!empty($title)){
        $query = "SELECT *
        FROM Papers
        WHERE Title = '$title'";
    }

    // SEARCH BY AUTHOR
    else if (!empty($author)){
        $query = "SELECT *
        FROM Papers
        WHERE Authors = '$author'";
    }

    // SEARCH BY AUTHOR AND TITLE
    else if (!empty($author) && !empty($title)){
        $query = "SELECT *
        FROM Papers
        WHERE Title = '$title'
        AND Authors = '$author'";
    }

    // SEARCH BY KEYWORDS  (NOTE: NOT SU RE IF KEYWORDS BEING INCLUDED? NOT IN DATABASE DIAGRAM)
    else if (!empty($keywords)) {
        $query = "SELECT *
        FROM Papers
        WHERE keywords = '$keywords'";
    }

    // SEARCH BY TITLE & KEYWORDS
    else if (!empty($keywords) && !empty($title)) {
        $query = "SELECT *
        FROM Papers
        WHERE keywords = '$keywords'
        AND Title = '$title'";
    }

    // SEARCH BY AUTHOR, TITLE & KEYWORDS
    else if (!empty($keywords) && !empty($title) && !empty($author)) {
        $query = "SELECT *
        FROM Papers
        WHERE keywords = '$keywords'
        AND Title = '$title'
        AND Authors = '$author'";
    }

    // SEARCH BY PUBLICATION YEAR
    else if (!empty($publicationYear)) {
        $query = "SELECT *
        FROM Papers
        WHERE Year = '$publicationYear'";
    }

    // SEARCH BY AUTHOR, TITLE & PUBLICATION YEAR
    else if (!empty($author) && !empty($title) && !empty($publicationYear)){
        $query = "SELECT *
        FROM Papers
        WHERE Title = '$title'
        AND Authors = '$author'
        AND Year = '$publicationYear'";
    }

    //SEARCH BY NO. OF CITATIONS
    else if (!empty($citationsMin) && !empty($citationsMax)) {
        $query = "SELECT *
        FROM Papers
        WHERE Cites BETWEEN '$citationsMin' AND '$citationsMax'";
    }

    // SEARCH BY NO. OF CITATIONS & TITLE
    else if (!empty($title) && !empty($citationsMin) && !empty($citationsMax)) {
        $query = "SELECT *
        FROM Papers
        WHERE Cites BETWEEN '$citationsMin' AND '$citationsMax'
        AND Title = '$title'";
    }

    // SEARCH BY NO. OF CITATIONS, TITLE & AUTHOR
    else if (!empty($title) && !empty($author) && !empty($citationsMin) && !empty($citationsMax)) {
        $query = "SELECT *
        FROM Papers
        WHERE Cites BETWEEN '$citationsMin' AND '$citationsMax'
        AND Title = '$title'
        AND Authors = '$author'";
    }

    return $query;

}; ?>

<html lang ="en">
<head>
	<title>Group 4 SPMIS</title>
	<meta charset = "utf-8" /><!--sets the character encoding for unicode-->
	<link rel='stylesheet' type ='text/css' href='style.css'/><!--links to my style sheet-->

	<body>
		<table id = "mainTable" border ="1" style = "double" width = "60%">

<?php

$user = 'root';
$pass = '';
$con = mysqli_connect('localhost', $user, $pass, 'scientificpapers');
//connects the database using my credentials. if it does not connect it "dies"
//and displays an error
if (!$con){
	die("Failed to connect: " .mysqli_connect_error());
}



$query = chooseQuery(); // $query variable to replace following MySql statement once correct database is created.
$r = mysqli_query($con, $query, MYSQLI_STORE_RESULT)
    or die("Failed to connect: " .mysqli_error($con));
while($row = mysqli_fetch_array($r)){
	echo "<tr>";
	echo "<td><br>".$row['Authors']."</td>";
	echo "<td>".$row['Title']."</td>";
    	echo "<td><a href=".$row['ArticleURL'].">".$row['ArticleURL']."</a></td>";

}

mysqli_close($con);

?>

</html>
