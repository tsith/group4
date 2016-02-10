<?php

function connect($host, $user, $pass, $database)
{
    if (!mysqli_connect($host, $user, $pass, $database)) {
        return die("Failed to connect: " . mysqli_connect_error());
    }

    else { return mysqli_connect($host, $user, $pass, $database); }
}


function closeConnection($connection) {
    $closeCon = mysqli_close($connection);

    if ($closeCon == 0) { echo "Failed to close database connection."; }
}


function chooseQuery(){
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

    else { die("Failed to find correct query."); }

    return $query;

};

?>
