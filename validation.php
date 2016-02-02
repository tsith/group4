<script>
    function chooseQuery(){
        var title = document.getElementByID('title').value;
        var author = document.getElementById('name').value;
        var keywords = document.getElementById('keywords').value;
        var publicationYear = document.getElementById('Year').value;
        var citationsMin = document.getElementById('citationsMin').value;
        var citationsMax = document.getElementById('citationsMax').value;

        // USE MAIN SEARCH (TITLE)
        if (!title == ""){
            <? $query = "SELECT *
            FROM Paper
            WHERE TitleID = '$title'";
            ?>
        }

        // SEARCH BY AUTHOR AND TITLE
        if (!author == "" && title == ""){
            <? $query = "SELECT p.*
            FROM Author a, Paper p
            WHERE p.AuthorID = a.AuthorID
            AND p.Title = '$title'
            AND a.Author = '$author'"; ?>
        }

        // SEARCH BY KEYWORDS  (NOTE: NOT SURE IF KEYWORDS BEING INCLUDED? NOT IN DATABASE DIAGRAM)
        if (!keywords == "") {
            <? $query = "SELECT *
              FROM Paper
              WHERE keywords = '$keywords'";?>
        }

        // SEARCH BY TITLE & KEYWORDS
        if (!keywords == "" && !title == "") {
            <? $query = "SELECT *
              FROM Paper
              WHERE keywords = '$keywords'
              AND title = '$title'";?>
        }

        // SEARCH BY AUTHOR, TITLE & KEYWORDS
        if (!keywords == "" && !title == "" && !author == "") {
            <? $query = "SELECT *
              FROM Paper p, Author a
              WHERE p.keywords = '$keywords'
              AND p.title = '$title'
              AND a.Author = '$author'";?>
        }

        // SEARCH BY AUTHOR, TITLE & PUBLICATION YEAR
        if (!author == "" && !title == "" && !publicationYear == ""){
            <? $query = "SELECT p.*
            FROM Author a, Paper p
            WHERE p.AuthorID = a.AuthorID
            AND p.Title = '$title'
            AND a.Author = '$author'
            AND p.PYear = '$year'"; ?>
        }

        //SEARCH BY NO. OF CITATIONS
        if (!citationsMin == "" && citationsMax == "") {
            <? $query = "SELECT *
            FROM Paper
            WHERE CitationCount BETWEEN '$citationsMin' AND '$citationsMax'"; ?>
    }
        // SEARCH BY NO. OF CITATIONS & TITLE
        if (!title == "" && !citationsMin == "" && citationsMax == "") {
            <? $query = "SELECT *
            FROM Paper
            WHERE CitationCount BETWEEN '$citationsMin' AND '$citationsMax'
            AND TitleID = '$title'"; ?>
        }

        // SEARCH BY NO. OF CITATIONS, TITLE & AUTHOR
        if (!author == "" && !title == "" && !citationsMin == "" && citationsMax == "") {
            <? $query = "SELECT *
            FROM Paper p, Author a
            WHERE p.CitationCount BETWEEN '$citationsMin' AND '$citationsMax'
            AND p.TitleID = '$title'
            AND a.Author = '$name'"; ?>
        }

</script>
