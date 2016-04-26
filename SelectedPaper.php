<html lang ="en">
<head>
	<title>Selected Paper</title>
	<meta charset = "utf-8" /><!--sets the character encoding for unicode-->
	<link rel='stylesheet' type ='text/css' href='style.css'/><!--links to my style sheet-->
	<link rel="stylesheet" type="text/css" href="foundation.css"/>
	<script type="text/javascript" src="javaScripts.js"></script>
<body>


<div class="titled">
<div class="logo"><a href="MainPage.php"><img src="logo.png" alt="Mountain View" style="width:50px;height:50px;"></a></div><!--ADDS THE LOGO TO THE WEBSITE-->
<h1>Selected Paper</h1>
	<div class = 'contained'>
		<h3>Title: <?php echo '<font color="white">'.$_POST['sendTitle'].'</font>';?></h3>
		<table class= "summary"><tr><td><?php echo $_POST['sendSummary'];?></td></tr></table>
		<h3>Author: <?php echo '<font color="white">'.$_POST['sendAuthor'].'</font>';?></h3>

		<h3>Publisher: <?php echo '<font color="white">'.$_POST['sendPublisher'].'</font>';?></h3>
		<h3>Year Published: <?php echo '<font color="white">'.$_POST['sendYear'].'</font>';?></h3>
		<h3>Citations: <?php echo '<font color="white">'.$_POST['sendCites'].'</font>';?></h3>

		<div id="PaperIndent"><?php echo "<form method='get' target='_blank' action=".$_POST['sendURL']."><button type='submit'>Go to Paper</button></form>";?></div>
	</div>
</div>
</body>
</html>
