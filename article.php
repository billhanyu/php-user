<!DOCTYPE html>
<?php
include('config.php');
?>
<html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width initial-scale=1">
<link rel = "stylesheet" type = "text/css" href = "styles.css">
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {	
	$articleId = $_GET['postId'];
	$query = "SELECT * FROM post WHERE id = " . $articleId;
	$retrieval = mysqli_query($db, $query);
	if (! $retrieval) {
		die('Could not get data: ' . mysql_error());
	}
	$article = mysqli_fetch_assoc($retrieval);
}
?>

<head>
<title><?php echo $article['topic']?></title>
</head>

<body>
<div>
	<div class = "header">
		<?php
			echo "<h1><a href = 'welcome.php'>Bill Yu</a></h1>";
			echo "<a id = 'functions' href = 'login.php?postId="
						. $articleId
						. "'>Log In</a>";
		?>
	</div>
	<div class = "content">
		<?php
			echo "<h2>" . $article['topic'] . "</h2>";
			echo "<p>" . $article['content'] . "</p>";
		?>
	</div>
</div>
<div class = "footer">
	Bill Yu	
</div>
</body>
</html>	
