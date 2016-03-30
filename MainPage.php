<?php
if (isset($_COOKIE['Query'])){
	echo "Previous Search =  ". $_COOKIE['Query']."<BR>";
}
else echo "";

?>

<html lang ="en">
<head>
	<title>Student Search</title>
	<meta charset = "utf-8" /><!--sets the character encoding for unicode-->
	<link rel='stylesheet' type ='text/css' href='style.css'/><!--links to my style sheet-->
	<link rel="stylesheet" type="text/css" href="foundation.css"/>
	<script type="text/javascript" src="javaScripts.js"></script>

<body onload ="div_hide()">
<div class="area">
<div class = 'container-1'>
	
			<h1>Student Scholar</h1>
			<h3>Search for a paper</h3>
			<form method ="post" name ="searchBox"  action ="search.php" id="searchform">
                <input type='search' name = 'title' id = "title"  size = '15' placeholder = 'Search...' autofocus >

                <select class="sort" name="sort" form="searchform">
                    <option value="" disabled selected>Sort by:</option>
                    <option value="sortCitationsDesc" name="sortCitationsDesc">Most Citations</option>
                    <option value="sortCitationsAsc" name="sortCitationsAsc">Least Citations</option>
                    <option value="sortYearAsc" name="sortYearAsc">Oldest</option>
                    <option value="sortYearDesc" name="sortYearDesc">Newest</option>
                </select>

                <input id ="searchbutton" class="button" type = "submit" name="submit" value ="Search" onclick="checkTextField(this)">
                <br>

                <!--<href="#" id = "AdditionalSearch" class = "button" onclick= "div_show()" id="popup">Additional Search-->
			<div id="IndentBit"><input id="AdditionalSearch" class= "button" href="#" onclick="div_show()" id= "popup" width="5" value="Additional Search"></div>
			
			</form>
 	</div>
</div>


<div id="abc" class="callout" visibility="hidden" data-closable>
<!-- Popup Div Starts Here -->
	<button class="close-button" aria-label="Dismiss alert" type="button" data-close onclick="div_hide()">
         <span aria-hidden="true">&times;</span>
    </button>
<div id="popupContact">
	<!-- Contact Us Form -->
	<form action="search.php" id="form" method="post" name="form">

	<h2>Additional Search</h2>
	<hr>
	<label>Author<input id="author" name="name" placeholder="e.g. McCain" size = "25" type="text"></label>
	<label>Title<input id="title" name="title" placeholder="e.g. Networks and the internet" size = "25" type="text"></label>
	<label>Keywords<input id="keywords" name="keywords" placeholder="e.g. Networks, router" size = "25" type="text"></label>
	<label>Published in<input id="publisher" name="publisher" placeholder="e.g. Computer Science" size = "25" type="text"></label>
	<label>Year Published<input id="Year" name="Year" placeholder="e.g. 1996" size ="4" maxlength = "4" type="text"></label></label>
	<label>No. Of Citations (min)<input id="citationsMin" name="citationsMin" placeholder="e.g. 10" size ="4" maxlength = "4" type="text"></label></label>
	<label>No. Of Citations (max)<input id="citationsMax" name="citationsMax" placeholder="e.g. 120" size ="4" maxlength = "4" type="text"></label></label>

        <select class="sort" name="sort" form="form">
            <option value="" disabled selected>Sort by:</option>
            <option value="sortCitationsDesc" name="sortCitationsDesc">Most Citations</option>
            <option value="sortCitationsAsc" name="sortCitationsAsc">Least Citations</option>
            <option value="sortYearAsc" name="sortYearAsc">Oldest</option>
            <option value="sortYearDesc" name="sortYearDesc">Newest</option>
        </select>

        
	<input id ="searchbutton" class="button float-right" type = "submit" name="submit" value ="Search" onclick ="checkAdditionalSearch(this)">

	</form>
</div>
<!-- Popup Div Ends Here -->

</div>
<!-- Display Popup Button -->


</body>

<!--Cites, Authors, Title, Year, Source, Publisher, ArticleURL, CitesURL, GSRank, QueryDate, Type -->
</html>
