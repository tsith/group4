<html lang ="en">
<head>
	<title>Selected Paper</title>
	<meta charset = "utf-8" /><!--sets the character encoding for unicode-->
	<link rel='stylesheet' type ='text/css' href='style.css'/><!--links to my style sheet-->
	<link rel="stylesheet" type="text/css" href="foundation.css"/>
	<script type="text/javascript" src="javaScripts.js"></script>
<body>

<div class="titled">
<h1>Selected Paper</h1>
	<div class = 'contained'>
		<h3>Title: <?php echo $_POST['sendTitle'];?></h3>
		<textarea class="summary" disabled><?php echo $_POST['sendSummary'];?></textarea>
		<h3>Author: <?php echo $_POST['sendAuthor'];?></h3>

		<h3>Publisher: <?php echo $_POST['sendPublisher'];?></h3>
		<h3>Year Published: <?php echo $_POST['sendYear'];?></h3>
		<h3>Citations: <?php echo $_POST['sendCites'];?></h3>

		<div id="PaperIndent"><?php echo "<form method='get' target='_blank' action=".$_POST['sendURL']."><button type='submit'>Go to Paper</button></form>";?></div>
	</div>
</div>
</body>
</html>
