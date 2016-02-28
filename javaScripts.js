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
	var content = "";
	var correctInput = new RegExp("^[a-z A-Z ]+(\s[a-z A-Z ]+)?$");
	var nameCheck = correctInput.exec(searchBox.title.value);

	if (!nameCheck){
      content += "Your search cannot contain digits, special characters or be empty \n\n";}

    if(!content =="") //if content is not empty
      {alert(content); 
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

	var content = "";
	var correctInputs = new RegExp("^[a-z A-Z ]+(\s[a-z A-Z ]+)?$");
	var keywordInput = new RegExp("^[a-z A-Z ,\,]+(\s[a-z A-Z]+)?$");
	var numberCheck = new RegExp("^\\d{4}$");

	var authorCheck = correctInputs.exec(additionalBox.author.value);

	if (!authorCheck){
		content += "The author field can only contain letters \n\n";}

    var titleCheck = correctInputs.exec(additionalBox.title.value);

    if (!titleCheck){
    	content += "The title field can only contain letters \n\n";}

    var keywordsCheck = keywordInput.exec(additionalBox.keywords.value);

	if (!keywordsCheck){
		content += "The keywords field can only contain letters and commas \n\n";}

    var publisherCheck = correctInputs.exec(additionalBox.publisher.value);

	if (!publisherCheck){
		content += "The publisher field can only contain letters \n\n";}

	var yearCheck = numberCheck.exec(additionalBox.Year.value);

	if (!yearCheck){
		content += "The year field can only contain 4 digits \n\n";}

	var citationMinCheck = numberCheck.exec(additionalBox.citationsMin.value);

	if (!citationMinCheck){
		content += "The citation min field can only contain digits \n\n";}

	var citationMaxCheck = numberCheck.exec(additionalBox.citationsMax.value);

	if (!citationMaxCheck){
		content += "The citation max field can only contain digits \n\n";}


    if(!content =="") //if content is not empty
      {alert(content); 
      	form = document.getElementById("form");
		form.action = "MainPage.php";



	}}


