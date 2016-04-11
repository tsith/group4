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
		<h2><?php echo $_POST['sendTitle'];?></h2>
		
		<h3><?php echo $_POST['sendAuthor'];?></h3>

		<h4><?php echo $_POST['sendPublisher'];?></h4>

		<div id="PaperIndent"><button class="button">Go to Paper</button></div>
	</div>
</div>
</body>
</html>
