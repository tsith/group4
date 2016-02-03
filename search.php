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
        FROM Paper
        WHERE TitleID = '$title'";
    }

    // SEARCH BY AUTHOR AND TITLE
    if (!empty($author) && !empty($title)){
        $query = "SELECT p.*
        FROM Author a, Paper p
        WHERE p.AuthorID = a.AuthorID
        AND p.Title = '$title'
        AND a.Author = '$author'";
    }

    // SEARCH BY KEYWORDS  (NOTE: NOT SURE IF KEYWORDS BEING INCLUDED? NOT IN DATABASE DIAGRAM)
    if (!empty($keywords)) {
        $query = "SELECT *
        FROM Paper
        WHERE keywords = '$keywords'";
    }

    // SEARCH BY TITLE & KEYWORDS
    if (!empty($keywords) && !empty($title)) {
        $query = "SELECT *
        FROM Paper
        WHERE keywords = '$keywords'
        AND title = '$title'";
    }

    // SEARCH BY AUTHOR, TITLE & KEYWORDS
    if (!empty($keywords) && !empty($title) && !empty($author)) {
        $query = "SELECT *
        FROM Paper p, Author a
        WHERE p.keywords = '$keywords'
        AND p.title = '$title'
        AND a.Author = '$author'";
    }

    // SEARCH BY AUTHOR, TITLE & PUBLICATION YEAR
    if (!empty($author) && !empty($title) && !empty($publicationYear)){
        $query = "SELECT p.*
        FROM Author a, Paper p
        WHERE p.AuthorID = a.AuthorID
        AND p.Title = '$title'
        AND a.Author = '$author'
        AND p.PYear = '$year'";
    }

    //SEARCH BY NO. OF CITATIONS
    if (!empty($citationsMin) && !empty($citationsMax)) {
        $query = "SELECT *
        FROM Paper
        WHERE CitationCount BETWEEN '$citationsMin' AND '$citationsMax'";
    }

    // SEARCH BY NO. OF CITATIONS & TITLE
    if (!empty($title) && !empty($citationsMin) && !empty($citationsMax)) {
        $query = "SELECT *
        FROM Paper
        WHERE CitationCount BETWEEN '$citationsMin' AND '$citationsMax'
        AND TitleID = '$title'";
    }

    // SEARCH BY NO. OF CITATIONS, TITLE & AUTHOR
    if (!empty($title) && !empty($author) && !empty($citationsMin) && !empty($citationsMax)) {
        $query = "SELECT *
        FROM Paper p, Author a
        WHERE p.CitationCount BETWEEN '$citationsMin' AND '$citationsMax'
        AND p.TitleID = '$title'
        AND a.Author = '$author'";
    } else { $query = ""; }

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
$query = "";
$con = mysqli_connect("csmysql.cs.cf.ac.uk", "c1416357", "efkiv6", "c1416357");
//connects the database using my credentials. if it does not connect it "dies"
//and displays an error
if (!$con){
	die("Failed to connect: " .mysqli_connect_error());
}



$query = chooseQuery(); // $query variable to replace following MySql statement once correct database is created.
$r = mysqli_query($con, "SELECT * FROM CompSci");
while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
	echo "<tr>";
	echo "<td><br>".$row['Authors']."</td>";
	echo "<td>".$row['Title']."</td>";
}

mysqli_close($con);

?>

</html>
