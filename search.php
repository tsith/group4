<html lang ="en">
<head>
	<title>Group 4 SPMIS</title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"><!--sets the character encoding for unicode-->
	<link rel='stylesheet' type ='text/css' href='style.css'/><!--links to my style sheet-->
	<link rel='stylesheet' type ='text/css' href= 'foundation.css'/><!--links to my style sheet-->
	<script type="text/javascript" src="javaScripts.js"></script><!--Links to the javascript file which carries out the error checking-->
	
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
                <!--when the search button is clicked it runs the validation in the javaScript file that ensures the input entered is correct-->
                <input id ="searchbutton" class="button" type = "submit" name="submit" value ="Search" onclick="checkTextField(this)">
                <br>
			
			</form>
 	</div>
 </div>

<table id = "mainTable" border ="1" style = "double" width = "60%">
    <caption id='tableHeading'>Search Results</caption>
                        
                        
<?php
//ADDS THE FUNCTIONS.PHP FILE SO THE METHODS CAN BE ACCESSED 

include "functions.php";

//CONNECTS TO THE DATABASE USING THE CORRECT CREDENTIALS
$con = connect('csmysql.cs.cf.ac.uk', 'group4.2015', 'A3bb6@4kmna', 'group4_2015');
mysqli_set_charset($con,"utf8"); //MAKES SURE THE CHARACTER ENCODING OF THE DATA IS UTF-8

//THE COMMON WORDS ARE SET HERE SO THAT WE CAN REMOVE THEM WHEN SETTING THE VALUE OF THE PASSED INFORMATION
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
//$keywords = keywordCount($title);


//SETS THE SEARCH TERM ENTERED (TITLE) TO BE THE COOKIE VALUE
if (!isset($_COOKIE['Query'])){
  setcookie("Query", $title);
}
//IF THE COOKIE IS SET THEN MAKE A LINK TO THE MAIN PAGE FOR THE USER TO SEE THEIR PREVIOUS SEARCH TERMS
if(isset($_COOKIE['Query'])){
	setcookie("Query", $title);
	echo "<a href='MainPage.php'>Previous Searches</a>";
}

// DEVELOPMEPER NOTE: SHOW CURRENT QUERY -> TO BE REMOVED IN FINAL VERSION.
echo "<br>" . $query;

//CREATES A TABLE FOR THE RESULTS OF THE SEARCH TERMS ENTERED
//ECHOING OUT THE AUTHORS, TITLE, ARTICLE URL AND SUMMARY
//IF CANNOT CONNECT TO THE DATABASE THEN DISPLAY A MYSQLI ERROR
//SENDS HIDDEN DATA FOR THE selectedPaper.php PAGE 

$r = mysqli_query($con, $query, MYSQLI_STORE_RESULT)
    or die("Failed to connect: " . mysqli_error($con));

while($row = mysqli_fetch_array($r)){
    echo "<tr>";
    echo "<th id='tableHeading'>Citations</th>";
    echo "<th id='tableHeading'>Author</th>";
    echo "<th id='tableHeading'>Title</th>";
    echo "<th id='tableHeading'>Year</th>";
    echo "<th id='tableHeading'>Article URL</th>";
    echo "<th id='tableHeading'>Summary</th>";
    echo "<th id='tableHeading'>More Information</th>";
    echo "</tr>";
    echo"<tr>";
    echo "<td>".$row['Cites']."</td>";
	echo "<td><br>".$row['Authors']."</td>";
	echo "<td>".$row['Title']."</td>";
    echo "<td>".$row['Year']."</td>";
    echo "<td><a href=".$row['ArticleURL'].">".$row['ArticleURL']."</a></td>";
    echo "<td><br>".$row['Summary']."</td>";
    echo "<form method ='post' name ='moreInfo' action='SelectedPaper.php' id='moreInfo'>
    <td><button type='submit' class='button'>More Info</button></td>
    <input type='hidden' id='sendTitle' name='sendTitle' value='".$row['Title']."'>
    <input type='hidden' id='sendAuthor' name='sendAuthor' value='".$row['Authors']."'>
    <input type='hidden' id='sendPublisher' name='sendPublisher' value='".$row['Publisher']."'>
    <input type='hidden' id='sendYear' name='sendYear' value='".$row['Year']."'>
    <input type='hidden' id='sendCites' name='sendCites' value='".$row['Cites']."'>
    <input type='hidden' id='sendSummary' name='sendSummary' value='".$row['Summary']."'>
    <input type='hidden' id='sendURL' name='sendURL' value='".$row['ArticleURL']."'></form>";

}

?>
<table id = "suggestedTable" border ="2" style = "double" width = "20%">
	<caption id='tableHeading'>Suggested Papers</caption>
<?php
//CALLS THE SUGGESTEDPAPERS() FUNCTION FROM THE FUNCTIONS.PHP FILE

$test = suggestedPapers($publisher);
//$keywordTest = retrieveKeywords();

//CREATES A TABLE FOR THE RESULTS OF SUGGESTED PAPERS
//ECHOING OUT THE AUTHORS, TITLE, ARTICLE URL AND SUMMARY
//IF CANNOT CONNECT TO THE DATABASE THEN DISPLAY A MYSQLI ERROR

$r1 = mysqli_query($con, $test, MYSQLI_STORE_RESULT)
    or die("Failed to connect: " . mysqli_error($con));

while($row = mysqli_fetch_array($r1)){
    echo "<tr>";
    echo "<th id='tableHeading'>Citations</th>";
    echo "<th id='tableHeading'>Author</th>";
    echo "<th id='tableHeading'>Title</th>";
    echo "<th id='tableHeading'>Year</th>";
    echo "<th id='tableHeading'>Article URL</th>";
    echo "<th id='tableHeading'>Summary</th>";
    echo "<th id='tableHeading'>More Information</th>";
    echo "</tr>";
    echo"<tr>";
    echo "<td>".$row['Cites']."</td>";
	echo "<td><br>".$row['Authors']."</td>";
	echo "<td>".$row['Title']."</td>";
    echo "<td>".$row['Year']."</td>";
	echo "<td><a href=".$row['ArticleURL'].">".$row['ArticleURL']."</a></td>";
	echo "<td><br>".$row['Summary']."</td>";
    echo "<form method ='post' name ='moreInfo' action='SelectedPaper.php' id='moreInfo'>
    <td><button type='submit' class='button'>More Info</button></td>
    <input type='hidden' id='sendTitle' name='sendTitle' value='".$row['Title']."'>
    <input type='hidden' id='sendAuthor' name='sendAuthor' value='".$row['Authors']."'>
    <input type='hidden' id='sendPublisher' name='sendPublisher' value='".$row['Publisher']."'>
    <input type='hidden' id='sendYear' name='sendYear' value='".$row['Year']."'>
    <input type='hidden' id='sendCites' name='sendCites' value='".$row['Cites']."'>
    <input type='hidden' id='sendSummary' name='sendSummary' value='".$row['Summary']."'>
    <input type='hidden' id='sendURL' name='sendURL' value='".$row['ArticleURL']."'></form>";


}

?>
</html>
