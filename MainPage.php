<!--THIS PHP SECTION PRINTS OUT THE COOKIE SET FROM THE SEARCH TERMS AND ECHOS IT TO THE SCREEN
    IF NO COOKIE IS SET THEN NOTHING IS ECHOED OUT
<?php
/*if (isset($_COOKIE['Query'])){
    echo "Previous Search =  ". $_COOKIE['Query']."<BR>";
}
else echo "";*/

?> -->
<html lang ="en">
<head>
    <title>Student Search</title>
    <meta charset = "utf-8" /><!--sets the character encoding for unicode-->
    <link rel='stylesheet' type ='text/css' href='style.css'/><!--links to my style sheet-->
    <link rel="stylesheet" type="text/css" href="foundation.css"/>
    <script type="text/javascript" src="javaScripts.js"></script>

<body onload ="div_hide()">
<div class="area">

           <div id ="IndentTitle">
            <h1>Paper Search</h1>
            <h3>Search for a paper</h3>
        </div>

            <div class="logo"><!--ADDS THE LOGO TO THE WEBSITE-->
            <a href="MainPage.php"><img src="logo.png" alt="Mountain View" style="width:50px;height:50px;"></a></div>

            <div class = 'container-1'>

            <form method ="post" name ="searchBox"  action ="search.php" id="searchform">
                <input type='search' name = 'title' id = "title"  size = '15' placeholder = 'Search...' autofocus >


                <!--THE SEARCH BUTTON WHEN CLICKED CALLS THE javaScript.js FILE TO CHECK THE INPUT ENTERED MATCHES THE VALIDATION -->
                <input id ="searchbutton" class="button" type = "submit" name="submit" value ="Search" onclick="checkTextField(this)">
                <br>
            </div>

            <div class ='container-2'>
                <div id='IndentDropdown'>
                <!--SETS THE COMBO BOX FOR SORTING THE PAPERS WHEN RETURNED, WHETHER SORTED BY NUMBER OF CITATIONS OR YEAR PUBLISHED-->
                <select id ="sort" class="sort" name="sort" form="searchform">
                    <option value="" disabled selected>Sort by:</option>
                    <option value="sortCitationsDesc" name="sortCitationsDesc">Most Citations</option>
                    <option value="sortCitationsAsc" name="sortCitationsAsc">Least Citations</option>
                    <option value="sortYearAsc" name="sortYearAsc">Oldest</option>
                    <option value="sortYearDesc" name="sortYearDesc">Newest</option>
                </select>
                
                <!--SETS THE COMBO BOX FOR LIMITING THE AMOUNT OF PAPERS YOU WISH TO DISPLAY-->
                <select id= "noOfResults" class="noOfResults" name="noOfResults" form="searchform">
                    <option value="" disabled selected>No. of Results to Show:</option>
                    <option value="show10" name="show10">10</option>
                    <option value="show50" name="show50">50</option>
                    <option value="show100" name="show100">100</option>
                    <option value="show250" name="show250">250</option>
                </select>
            </div>
            </div>              

                <!--<href="#" id = "AdditionalSearch" class = "button" onclick= "div_show()" id="popup">Additional Search-->
            <div id="IndentBit"><input id="AdditionalSearch" class= "button" href="#" onclick="div_show()" id= "popup" width="5" value="Advanced Search"></div>
            <!--DIPLAYS THE POPUP BOX WITH THE ADVANCED SEARCH OPTIONS ON IT-->
            </form>
    </div>
</div>
</div>

<div id="abc" class="callout" visibility="hidden" data-closable>
<!-- Popup Div Starts Here -->
<div class="adSearch">
    <button  id="xbutton" class="close-button" aria-label="Dismiss alert" type="button" data-close onclick="div_hide()">
         <span aria-hidden="true">&times;</span>
    </button>
</div>
<div id="popupContact">
    <!-- Contact Us Form -->
    <form action="search.php" id="form" method="post" name="form">

    <h2>Advanced Search</h2>
    <hr>
    <label>Author<input id="author" name="name" placeholder="e.g. McCain" size = "25" type="text"></label>
    <label>Title<input id="title" name="title" placeholder="e.g. Networks and the internet" size = "25" type="text"></label>
    <label>Keywords<input id="keywords" name="keywords" placeholder="e.g. Networks, router" size = "25" type="text"></label>
    <label>Publisher<input id="publisher" name="publisher" placeholder="e.g. Springer" size = "25" type="text"></label>
    <label>Year Published<input id="Year" name="Year" placeholder="e.g. 1996" size ="4" maxlength = "4" type="text"></label></label>
    <label>No. Of Citations (min)<input id="citationsMin" name="citationsMin" placeholder="e.g. 10" size ="4" maxlength = "4" type="text"></label></label>
    <label>No. Of Citations (max)<input id="citationsMax" name="citationsMax" placeholder="e.g. 120" size ="4" maxlength = "4" type="text"></label></label>

        <!--SETS THE COMBO BOX FOR SORTING THE PAPERS WHEN RETURNED, WHETHER SORTED BY NUMBER OF CITATIONS OR YEAR PUBLISHED-->
        <select class="sort" name="sort" form="form">
            <option value="" disabled selected>Sort by:</option>
            <option value="sortCitationsDesc" name="sortCitationsDesc">Most Citations</option>
            <option value="sortCitationsAsc" name="sortCitationsAsc">Least Citations</option>
            <option value="sortYearAsc" name="sortYearAsc">Oldest</option>
            <option value="sortYearDesc" name="sortYearDesc">Newest</option>
        </select>
        
        <!--SETS THE COMBO BOX FOR LIMITING THE AMOUNT OF PAPERS YOU WISH TO DISPLAY-->
        <select class="noOfResults" name="noOfResults" form="form">
            <option value="" disabled selected>No. of Results to Show:</option>
            <option value="show10" name="show10">10</option>
            <option value="show50" name="show50">50</option>
            <option value="show100" name="show100">100</option>
            <option value="show250" name="show250">250</option>
        </select>

        
    <input id ="searchbutton" class="button float-right" type = "submit" name="submit" value ="Search" onclick ="checkAdditionalSearch(this)">

    </form>
</div>
<!-- Popup Div Ends Here -->

</div>
<!-- Display Popup Button -->


</body>

</html>
