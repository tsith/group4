<?php

function chooseQuery(){
    $query = "";
    $author = $_POST['name'];
    $title = $_POST['title'];
    $keywords = $_POST['keywords'];
    $year = $_POST['Year'];
    $citationsMin = $_POST['citationsMin'];
    $citationsMax = $_POST['citationsMax'];

// USE MAIN SEARCH (TITLE)
    if (isset($title)){
        $query = "SELECT *
                  FROM Paper
                  WHERE TitleID = '$title'";
    }

    // SEARCH BY AUTHOR AND TITLE
    if (isset($author) && isset($title)){
        $query = "SELECT p.*
                  FROM Author a, Paper p
                  WHERE p.AuthorID = a.AuthorID
                  AND p.Title = '$title'
                  AND a.Author = '$author'";
    }

    // SEARCH BY KEYWORDS  (NOTE: NOT SURE IF KEYWORDS BEING INCLUDED? NOT IN DATABASE DIAGRAM)
    if (isset($keywords)) {
        $query = "SELECT *
                  FROM Paper
                  WHERE keywords = '$keywords'";
    }

    // SEARCH BY TITLE & KEYWORDS
    if (isset($keywords) && isset($title)) {
        $query = "SELECT *
                  FROM Paper
                  WHERE keywords = '$keywords'
                  AND title = '$title'";
    }

// SEARCH BY AUTHOR, TITLE & KEYWORDS
    if (isset($keywords) && isset($title) && isset($author)) {
        $query = "SELECT *
                  FROM Paper p, Author a
                  WHERE p.keywords = '$keywords'
                  AND p.title = '$title'
                  AND a.Author = '$author'";
    }

// SEARCH BY AUTHOR, TITLE & PUBLICATION YEAR
    if (isset($author) && isset($title) && isset($publicationYear)){
        $query = "SELECT p.*
                FROM Author a, Paper p
                WHERE p.AuthorID = a.AuthorID
                AND p.Title = '$title'
                AND a.Author = '$author'
                AND p.PYear = '$year'";
    }

//SEARCH BY NO. OF CITATIONS
    if (isset($citationsMin) && isset($citationsMax) {
        $query = "SELECT *
                FROM Paper
                WHERE CitationCount BETWEEN '$citationsMin' AND '$citationsMax'";
    }

// SEARCH BY NO. OF CITATIONS & TITLE
    if (isset($title) && isset($citationsMin) && isset($citationsMax)) {
        $query = "SELECT *
                FROM Paper
                WHERE CitationCount BETWEEN '$citationsMin' AND '$citationsMax'
                AND TitleID = '$title'";
    }

// SEARCH BY NO. OF CITATIONS, TITLE & AUTHOR
    if (isset($title) && isset($author) && isset($citationsMin) && isset($citationsMax)) {
        $query = "SELECT *
                FROM Paper p, Author a
                WHERE p.CitationCount BETWEEN '$citationsMin' AND '$citationsMax'
                AND p.TitleID = '$title'
                AND a.Author = '$author'";
    }
    return $query;
};

?>

