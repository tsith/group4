<html lang ="en">
<head>
	<title>Group 4 SPMIS</title>
	<meta charset = "utf-8" /><!--sets the character encoding for unicode-->
	<link rel='stylesheet' type ='text/css' href='style.css'/><!--links to my style sheet-->
	<link rel='stylesheet' type ='text/css' href= 'foundation.css'/>
	<script type="text/javascript" src="javaScripts.js"></script>
	
	<body>

<div class = 'container-1'>
			<h3>Search for a paper</h3>
			<form method ="post" name ="searchBox"  action ="search.php" id="searchform">
                <input type='search' name = 'title' id = "title"  size = '15' placeholder = 'Search...' >

                <select class="sort" name="sort" form="searchform">
                    <option value="" disabled selected>Sort by:</option>
                    <option value="sortCitationsDesc" name="sortCitationsDesc">Most Citations</option>
                    <option value="sortCitationsAsc" name="sortCitationsAsc">Least Citations</option>
                    <option value="sortYearAsc" name="sortYearAsc">Oldest</option>
                    <option value="sortYearDesc" name="sortYearDesc">Newest</option>
                </select>
                
                <select class="noOfResults" name="noOfResults" form="searchform">
                    <option value="" disabled selected>No. of Results to Show:</option>
                    <option value="show10" name="show10">10</option>
                    <option value="show50" name="show50">50</option>
                    <option value="show100" name="show100">100</option>
                    <option value="show250" name="show250">250</option>
                </select>

                <input id ="searchbutton" class="button" type = "submit" name="submit" value ="Search" onclick="checkTextField(this)">
                <br>
			
			</form>
 	</div>
 </div>
  
<table id = "mainTable" border ="1" style = "double" width = "60%">
    <caption>Search Results</caption>
                        
                        
<?php

include "functions.php";
$con = connect('csmysql.cs.cf.ac.uk', 'group4.2015', 'A3bb6@4kmna', 'group4_2015');

$commonWords = 'and,the';

// GET USER INPUT VALUES & REMOVE COMMON WORDS
$title = removeCommonWords($commonWords, setVal('title'));
$author = removeCommonWords($commonWords, setVal('author'));
$publicationYear = removeCommonWords($commonWords, setVal('Year'));
$publisher = removeCommonWords($commonWords, setVal('publisher'));
$citationsMin = removeCommonWords($commonWords, setVal('citationsMin'));
$citationsMax = removeCommonWords($commonWords, setVal('citationsMax'));

// GET SORT SELECTION VALUES
$sortSelection = setVal('sort');

// GET MAX PAPERS TO SHOW
$maxPapers = setVal('noOfResults');

// FUNCTION TO CHOOSE CORRECT QUERY, SORT IF NECESSARY, LIMIT IF NECESSARY
$query = chooseQuery() . sortBy($sortSelection) . maxNoOfPapers($maxPapers);
$keywords = keywordCount($title);


// CHECK FOR PREVIOUS SEARCH
if (!isset($_COOKIE['Query'])){
  setcookie("Query", $title);
}
if(isset($_COOKIE['Query'])){
	setcookie("Query", $title);
	echo "<a href='MainPage.php'>Previous Searches</a>";
}

// DEVELOPMEPER NOTE: SHOW CURRENT QUERY -> TO BE REMOVED IN FINAL VERSION.
echo "<br>" . $query;

$r = mysqli_query($con, $query, MYSQLI_STORE_RESULT)
    or die("Failed to connect: " . mysqli_error($con));

while($row = mysqli_fetch_array($r)){
	echo "<tr>";
	echo "<td><br>".$row['Authors']."</td>";
	echo "<td>".$row['Title']."</td>";
    echo "<td><a href=".$row['ArticleURL'].">".$row['ArticleURL']."</a></td>";
    echo "<td><br>".$row['Summary']."</td>";

}

?>
<table id = "suggestedTable" border ="2" style = "double" width = "20%">
	<caption>Suggested Papers</caption>
<?php
$test = suggestedPapers($publisher);
//$keywordTest = retrieveKeywords();

$r1 = mysqli_query($con, $test, MYSQLI_STORE_RESULT)
    or die("Failed to connect: " . mysqli_error($con));

while($row = mysqli_fetch_array($r1)){
	echo "<tr>";
	echo "<td><br>".$row['Authors']."</td>";
	echo "<td>".$row['Title']."</td>";
	echo "<td><a href=".$row['ArticleURL'].">".$row['ArticleURL']."</a></td>";
	echo "<td><br>".$row['Summary']."</td>";
}

/*$r2 = mysqli_query($con, $keywordTest, MYSQLI_STORE_RESULT)
    or die("Failed to connect: " . mysqli_error($con));

     while($rows1 = mysqli_fetch_array($r2)){
        $keywordTest = explode(',', $rows1['Keywords']);
        foreach($keywordTest as $out){
            echo $out;
        }
    }*/

?>
</html>
