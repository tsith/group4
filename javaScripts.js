//Function to show Popup
function div_show() {
document.getElementById('abc').style.display = "block";
}
//Function to Hide Popup
function div_hide(){
document.getElementById('abc').style.display = "none";
}

//Function to check Search box is not empty
function checkTextField(){
	if (document.getElementById('title').value == ""){
		alert("Search criteria is blank");
		form = document.getElementById("searchform");
		form.action = "MainPage.php";
	}
}
//Function to check that additional search values have some information
function checkAdditionalSearch(){
	if (document.getElementById('author').value == "" && document.getElementById('title').value == "" && document.getElementById('keywords').value == "" && document.getElementById('publisher').value == "" && document.getElementById('Year').value == "" && document.getElementById('citationsMin').value == "" && document.getElementById('citationsMax').value == ""){
		alert("You must enter some information");
		form = document.getElementById("form");
		form.action = "MainPage.php";}
	}
