<?php

function connect($host, $user, $pass, $database){ // connect to database

    if (!mysqli_connect($host, $user, $pass, $database)) {
        return die("Failed to connect: " . mysqli_connect_error());
    }

    else { return mysqli_connect($host, $user, $pass, $database); }
}


function closeConnection($connection) { // closes & checks connection is closed
    $closeCon = mysqli_close($connection);

    if ($closeCon == 0) { echo "Failed to close database connection."; }
}

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

    else if (strcmp($value, 'publicationYear') == 0) {
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

    //NOTE: Some form of error handling must be added to this function
    return $value;
}

function removeCommonWords($commonWords, $inputString) { // remove pre-defined common words
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


function chooseQuery(){
    global $title, $author, $publicationYear, $citationsMin, $citationsMax;
    $query = "";

    // USE MAIN SEARCH (TITLE)
    if (!empty($title) && empty($author)){
        $query = "SELECT *
        FROM Papers
        WHERE Title LIKE '%$title%'";
    }

    // SEARCH BY AUTHOR
    else if (!empty($author) && empty ($title)){
        $query = "SELECT *
        FROM Papers
        WHERE Authors LIKE '%$author%'";
    }

    // SEARCH BY AUTHOR AND TITLE
    else if (!empty($author) && !empty($title)){
        $query = "SELECT *
        FROM Papers
        WHERE Title LIKE '%$title%'
        AND Authors LIKE '%$author%'";
    }

    // SEARCH BY KEYWORDS  (NOTE: NOT SU RE IF KEYWORDS BEING INCLUDED? NOT IN DATABASE DIAGRAM)
    else if (!empty($keywords) && empty($author) && empty($title) && empty($publicationYear) && empty ($citationsMax) && empty($citationsMin)) {
        $query = "SELECT *
        FROM Papers
        WHERE keywords = '$keywords'";
    }

    // SEARCH BY TITLE & KEYWORDS
    else if (!empty($keywords) && !empty($title) && empty($author) && empty($publicationYear) && empty($citationsMin) && empty($citationsMax)) {
        $query = "SELECT *
        FROM Papers
        WHERE keywords = '$keywords'
        AND Title = '$title'";
    }

    // SEARCH BY AUTHOR, TITLE & KEYWORDS
    else if (!empty($keywords) && !empty($title) && !empty($author) && empty($publicationYear) && empty($citationsMax) && empty($citationsMin)) {
        $query = "SELECT *
        FROM Papers
        WHERE keywords = '$keywords'
        AND LIKE '%$title%'
        AND Authors = '$author'";
    }

    // SEARCH BY PUBLICATION YEAR
    else if (!empty($publicationYear) && empty($title) && empty($author) && empty($publicationYear) && empty($citationsMax) && empty($citationsMin)) {
        $query = "SELECT *
        FROM Papers
        WHERE Year = '$publicationYear'";
    }

    // SEARCH BY AUTHOR, TITLE & PUBLICATION YEAR
    else if (!empty($author) && !empty($title) && !empty($publicationYear) && empty($keywords) && empty($citationsMax) && empty($citationsMin)){
        $query = "SELECT *
        FROM Papers
        WHERE LIKE '%$title%'
        AND Authors = '$author'
        AND Year = '$publicationYear'";
    }

    //SEARCH BY NO. OF CITATIONS
    else if (!empty($citationsMin) && !empty($citationsMax) && empty($title) && empty($author) and empty($keywords) and empty($publicationYear)) {
        $query = "SELECT *
        FROM Papers
        WHERE Cites BETWEEN '$citationsMin' AND '$citationsMax'";
    }

    // SEARCH BY NO. OF CITATIONS & TITLE
    else if (!empty($title) && !empty($citationsMin) && !empty($citationsMax) && empty($author) and empty($keywords) and empty($publicationYear)) {
        $query = "SELECT *
        FROM Papers
        WHERE Cites BETWEEN '$citationsMin' AND '$citationsMax'
        AND Title = '$title'";
    }

    // SEARCH BY NO. OF CITATIONS, TITLE & AUTHOR
    else if (!empty($title) && !empty($author) && !empty($citationsMin) && !empty($citationsMax) and empty($keywords) and empty($publicationYear)) {
        $query = "SELECT *
        FROM Papers
        WHERE Title LIKE '%$title%'
        AND (Cites BETWEEN '$citationsMin' AND '$citationsMax')
        AND Authors = '$author'";
    }

    else { die("Error: Failed to find correct query."); }

    return $query;

};


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
function keywordCount($keywordInput){
    $text = $keywordInput;
    $words = str_word_count($text,1);
    $frequency = array_count_values($words);
    arsort($frequency);
    print_r($frequency);
}

function suggestedPapers($publisher){
    global $title;
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
        WHERE Title LIKE '%$title%'
        AND Keywords LIKE Keywords
        LIMIT 10";}
    return $suggested;
}

?>
