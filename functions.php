<?php
//THIS FUNCTION CONNECTS TO THE DATABASE. THE VARIABLES ARE PASSED THROUGH AND THE USERNAME/PASSWORD ARE ENTERED ON THE SEARCH.PHP FILE
//IF THERE IS A PROBLEM CONNECTING TO THE DATABASE THEN AN ERROR MESSAGE IS DISPLAYED

function connect($host, $user, $pass, $database){ // connect to database

    if (!mysqli_connect($host, $user, $pass, $database)) {
        return die("Failed to connect: " . mysqli_connect_error());
    }

    else { return mysqli_connect($host, $user, $pass, $database); }
}

//THIS FUNCTION MAKES SURE THAT THE DATABASE CONNECTION IS CLOSED AFTER IT HAS BEEN USED
//IF NOT IT PRODUCES AN ERROR SAYING IT FAILED TO CLOSE THE CONNECTION

function closeConnection($connection) { // closes & checks connection is closed
    $closeCon = mysqli_close($connection);

    if ($closeCon == 0) { echo "Failed to close database connection."; }
}

//THIS FUNCTION SETS ALL THE VALUES POSTED THROUGH THE WEBSITE WHEN A USER ENTERS A SEARCH TERM OR QUERY
function setVal($value) {  // set all POST values with this function

    if (strcmp($value, 'title') == 0) {
        if (!empty($_POST['title'])) {
            $value = $_POST['title'];
        } else $value = '';
    }
    
    else if (strcmp($value, 'author') == 0) {
        if (!empty($_POST['name'])) {
            $value = $_POST['name'];
        } else $value = '';
    }

    else if (strcmp($value, 'Year') == 0) {
        if (!empty($_POST['Year'])) {
            $value = $_POST['Year'];
        } else $value = '';
    }

    else if (strcmp($value, 'citationsMin') == 0) {
        if (!empty($_POST['citationsMin'])) {
            $value = $_POST['citationsMin'];
        } else $value = '';
    }

    else if (strcmp($value, 'citationsMax') == 0) {
        if (!empty($_POST['citationsMax'])) {
            $value = $_POST['citationsMax'];
        } else $value = '';
    }

    else if (strcmp($value, 'sort') == 0) {
        if (!empty($_POST['sort'])) {
            $value = $_POST['sort'];
        } else $value = '';
    }
    
    else if (strcmp($value, 'publisher') == 0) {
        if (!empty($_POST['publisher'])) {
            $value = $_POST['publisher'];
        } else $value = '';
    }
    
    else if (strcmp($value, 'Keywords') == 0) {
        if (!empty($_POST['Keywords'])) {
            $value = $_POST['Keywords'];
        } else $value = '';
        
    }
    
    else if (strcmp($value, 'noOfResults') == 0) {
        if (!empty($_POST['noOfResults'])) {
            $value = $_POST['noOfResults'];
        } else $value = '';
    }
    else echo "Error: the setValue function failed to find required POST value: " . $value . "</br>";

    return $value;
}

//THE FUNCTION removeCommonWords REMOVES ALL COMMON WORDS ENTERED BY THE USER SO THAT THE SQL CAN SEARCH FOR THE TERMS ENTERERED.
function removeCommonWords($commonWords, $inputString) { // remove pre-defined common words
    if (!is_string($inputString)) {
        echo "Error: " . $inputString . " is not of type String. </br>";
    }
    
    else if (!is_string($commonWords)) {
       echo "Error: " . $commonWords . " is not of type String. </br>";
    }
    
    else {
        $commonWords = str_replace(' ', '', $commonWords); // removes whitespace from commonWords var
        $commonWords = explode(",", $commonWords);
        $inputString = explode(" " , $inputString);
        
        foreach($inputString as $value){
            if(!in_array($value, $commonWords)){
                $outputString[] = $value;
            }
        }
        $outputString = implode(" ", $outputString);
        return $outputString;
    }
}

//THIS FUNCTION IS THE MAIN FUNCTION OF THE WEBSITE. IT IS HOW THE QUERY IS SELECTED IN ORDER TO RETURN THE RELEVANT RESULTS.
//$query IS SET TO BE THE CORRESPONDING QUERY DEPENDING ON THE SEARCH TERMS ENTERED BY THE USER. IF ITS THE MAIN TITLE SEARCH
//THEN THE SEARCH IS EVERYONE LIKE THAT TITLE. IF IT'S AUTHOR AND TITLE AND YEAR THEN IT NEEDS TO BE ALL THOSE FIELDS ETC...

function chooseQuery(){
    global $title, $author, $publicationYear, $citationsMin, $citationsMax, $publisher, $keywords;
    $query = "";

    // USE MAIN SEARCH (TITLE)
    if (!empty($title) && empty($author) && empty($publicationYear) && empty($citationsMin) && empty($citationsMax) && empty($publisher) && empty($keywords)){
        $query = "SELECT *
        FROM Papers
        WHERE Title LIKE '%$title%'";
    }

    // SEARCH BY AUTHOR
    else if (!empty($author) && empty($title) && empty($publicationYear) && empty($citationsMin) && empty($citationsMax) and empty($publisher) and empty($keywords)){
        $query = "SELECT *
        FROM Papers
        WHERE Authors LIKE '%$author%'";
    }

    // SEARCH BY AUTHOR AND TITLE
    else if (!empty($author) && !empty($title) && empty($publicationYear) && empty($citationsMin) && empty($citationsMax) and empty($publisher) and empty($keywords)){
        $query = "SELECT *
        FROM Papers
        WHERE Title LIKE '%$title%'
        AND Authors LIKE '%$author%'";
    }

    // SEARCH BY KEYWORDS  (NOTE: NOT SURE IF KEYWORDS BEING INCLUDED? NOT IN DATABASE DIAGRAM)
    else if (!empty($keywords) && empty($author) && empty($title) && empty($publicationYear) && empty ($citationsMax) && empty($citationsMin) and empty($publisher)) {
        $query = "SELECT *
        FROM Papers
        WHERE keywords = '$keywords'";
    }

    // SEARCH BY TITLE & KEYWORDS
    else if (!empty($keywords) && !empty($title) && empty($author) && empty($publicationYear) && empty($citationsMin) && empty($citationsMax) and empty($publisher)) {
        $query = "SELECT *
        FROM Papers
        WHERE keywords = '$keywords'
        AND Title Like '%$title%'";
    }

    // SEARCH BY AUTHOR, TITLE & KEYWORDS
    else if (!empty($keywords) && !empty($title) && !empty($author) && empty($publicationYear) && empty($citationsMax) && empty($citationsMin) and empty($publisher)) {
        $query = "SELECT *
        FROM Papers
        WHERE Keywords LIKE '%$keywords%'
        AND Title LIKE '%$title%'
        AND uthors LIKE '%$author%'";
    }

    // SEARCH BY PUBLICATION YEAR
    else if (!empty($publicationYear) && empty($title) && empty($author) && empty($publicationYear) && empty($citationsMax) && empty($citationsMin) and empty($publisher)) {
        $query = "SELECT *
        FROM Papers
        WHERE Year = '$publicationYear'";
    }

    // SEARCH BY AUTHOR, TITLE & PUBLICATION YEAR
    else if (!empty($author) && !empty($title) && !empty($publicationYear) && empty($keywords) && empty($citationsMax) && empty($citationsMin) and empty($publisher)){
        $query = "SELECT *
        FROM Papers
        WHERE Title LIKE '%$title%'
        AND Authors LIKE '%$author%'
        AND Year = '$publicationYear'";
    }

    //SEARCH BY NO. OF CITATIONS
    else if (!empty($citationsMin) && !empty($citationsMax) && empty($title) && empty($author) and empty($keywords) and empty($publicationYear) and empty($publisher)) {
        $query = "SELECT *
        FROM Papers
        WHERE Cites BETWEEN '$citationsMin' AND '$citationsMax'";
    }

    // SEARCH BY NO. OF CITATIONS & TITLE
    else if (!empty($title) && !empty($citationsMin) && !empty($citationsMax) && empty($author) and empty($keywords) and empty($publicationYear) and empty($publisher)) {
        $query = "SELECT *
        FROM Papers
        WHERE Cites BETWEEN '$citationsMin' AND '$citationsMax'
        AND Title LIKE '%$title%'";
    }

    // SEARCH BY NO. OF CITATIONS, TITLE & AUTHOR
    else if (!empty($title) && !empty($author) && !empty($citationsMin) && !empty($citationsMax) and empty($keywords) and empty($publicationYear) and empty($publisher)) {
        $query = "SELECT *
        FROM Papers
        WHERE Title LIKE '%$title%'
        AND (Cites BETWEEN '$citationsMin' AND '$citationsMax')
        AND Authors LIKE '%$author%'";
    }
    
    // SEARCH BY PUBLISHER
    else if (!empty($publisher) && empty($title) && empty($author) && empty($publicationYear) && empty($citationsMax) && empty($citationsMin) && empty($publicationYear)) {
        $query = "SELECT * "
                . "FROM Papers "
                . "WHERE Publisher LIKE '%$publisher%'";
    }

    // SEARCH BY PUBLISHER & TITLE
    else if (!empty($publisher) && !empty($title) && empty($author) && empty($publicationYear) && empty($citationsMax) && empty($citationsMin) && empty($publicationYear)) {
        $query = "SELECT * "
                . "FROM Papers "
                . "WHERE Publisher LIKE '%$publisher%' "
                . "AND Title LIKE '%$title%'";
    }
    
    // SEARCH BY PUBLISHER, TITLE & AUTHOR
    else if (!empty($publisher) && !empty($title) && empty(!$author) && empty($publicationYear) && empty($citationsMax) && empty($citationsMin) && empty($publicationYear)) {
        $query = "SELECT * "
                . "FROM Papers "
                . "WHERE Publisher LIKE '%$publisher%' "
                . "AND Title LIKE '%$title%' "
                . "AND Author LIKE '%$author%'";
    }
    
    else { die("Error: Failed to find correct query."); }

    return $query;

};

//The sortBy FUNCTION ALLOWS THE USER TO SORT THE PAPERS BY NUMBER OF CITATIONS OR BY YEAR PUBLISHED.
//THE FUNCTION USES THE SQL ORDER BY TO SORT THE PAPERS INTO THE ORDER SELECTED BY THE USER.
function sortBy($sortSelection) {
    $sortBy = "";

    if (isset($sortBy)) {
        if ($sortSelection == 'sortCitationsAsc') {
            $sortBy = " ORDER BY Cites ASC";
        } else if ($sortSelection == 'sortCitationsDesc') {
            $sortBy = " ORDER BY Cites DESC";
        } else if ($sortSelection == 'sortYearAsc') {
            $sortBy = " ORDER BY Year ASC";
        } else if ($sortSelection == 'sortYearDesc') {
            $sortBy = " ORDER BY Year DESC";
        } else {
            $sortBy = " ORDER BY Cites DESC";
        }
    }

    return $sortBy;
}
/*function keywordCount($keywordInput){
    $text = $keywordInput;
    $words = str_word_count($text,1);
    $frequency = array_count_values($words);
    arsort($frequency);
    print_r($frequency);

}*/

//THIS FUNCTION IS WHAT RETURNS THE SUGGESTED PAPERS. IF THE USER ENTERS A PUBLISHER THEN THE PUBLISHER IS USED TO FIND 
//SUGGESTED PAPERS OTHERWISE IT CHECKS FOR KEYWORDS THAT ARE SIMILAR TO THE SEARCH TERM ENTERED BY THE USER AND RETURNS THEM

function suggestedPapers($publisher){
    global $title;
    
    if (is_string($publisher)) {
    
        $suggested = "";
        if(!empty($publisher)){
            $suggested = "SELECT *
            FROM Papers p, suggestedPapers sp
            WHERE sp.Publisher = '$publisher'
            AND p.title = sp.title
            Order by p.Cites DESC
            LIMIT 5"; }

        else{ 
            $suggested = "SELECT *
            FROM Papers
            WHERE Keywords LIKE '%$title%'
            Order by Cites DESC
            LIMIT 10";
        }
        return $suggested;
    
    else echo "Error: " . $publisher . " is not of type String. </br>";
}

//THE maxNoOfPapers FUNCTION LIMITS THE AMOUNT OF PAPERS RETURNED. THE USER CAN SELECT 10, 50, 100 OR 250 RESULTS TO BE DISPLAYED.
function maxNoOfPapers($maxNo) {
    $limit = "";
    
    if ($maxNo == 'show10') {
        $limit = " LIMIT 10";
    }
    
    else if ($maxNo == 'show50') {
        $limit = " LIMIT 50";
    }
    
    else if ($maxNo == 'show100') {
        $limit = " LIMIT 100";
    }
    
    else if ($maxNo == 'show250') {
       $limit = " LIMIT 250";
    }
   else if (!empty($maxNo)) { echo "Error: " . $maxNo . " is not a valid option to sort by. </br>"; }

   return $limit;
    
}

/*function retrieveKeywords(){
    global $title;
    $keywordRetrieval = "SELECT *
    FROM Papers
    WHERE Title = $title";





    return $keywordRetrieval;}*/


?>

