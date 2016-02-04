<html lang ="en">
<head>
	<title>Student Search</title>
	<meta charset = "utf-8" /><!--sets the character encoding for unicode-->
	<link rel='stylesheet' type ='text/css' href='style.css'/><!--links to my style sheet-->
	<script type="text/javascript" src="javaScripts.js"></script>
<body onload ="div_hide()">
<div id = 'searcharea'>
			<h1>Student Scholar</h1>
			<h3>Search for a paper</h3>
			<form method ="post" name ="searchBox"  action ="search.php" id="searchform">
			<input type='text' name = 'titleOfPaper' id = "title"  size = '15' placeholder = 'Search...' autofocus>
			<input id ="searchbutton" type = "submit" name="submit" value ="Search" onclick="checkTextField(this)">
			<href="#" onclick= "div_show()" id="popup">Additional Search
			
			</form> 	     
 	</div>


<div id="abc" visbility = "hidden">
<!-- Popup Div Starts Here -->
<img src = "close.png" id = "xbutton" height = "40" weight = "40" onclick = "div_hide()">
<div id="popupContact">
<!-- Contact Us Form -->
<form action="search.php" id="form" method="post" name="form">

<h2>Additional Search</h2>
<hr>
<label>Author<input id="author" name="name" placeholder="e.g. McCain" size = "25" type="text"></label><br>
<label>Title<input id="title" name="title" placeholder="e.g. Networks and the internet" size = "25" type="text"></label><br>
<label>Keywords<input id="keywords" name="keywords" placeholder="e.g. Networks, router" size = "25" type="text"></label><br>
<label>Published in<input id="publisher" name="publisher" placeholder="e.g. Computer Science" size = "25" type="text"></label><br>
<label>Year Published<input id="Year" name="Year" placeholder="e.g. 1996" size ="4" maxlength = "4" type="text"></label><br></label>
<label>No. Of Citations (min)<input id="citationsMin" name="citationsMin" placeholder="e.g. 10" size ="4" maxlength = "4" type="text"></label><br></label>
<label>No. Of Citations (max)<input id="citationsMax" name="citationsMax" placeholder="e.g. 120" size ="4" maxlength = "4" type="text"></label><br></label>
<input id ="searchbutton" type = "submit" name="submit" value ="Search" onclick ="checkAdditionalSearch(this)">

</form>
</div>
<!-- Popup Div Ends Here -->
</div>
<!-- Display Popup Button -->

</body>
<!--Cites, Authors, Title, Year, Source, Publisher, ArticleURL, CitesURL, GSRank, QueryDate, Type -->
</html>


