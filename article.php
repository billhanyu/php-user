<!DOCTYPE html>
<?php
include('session.php');
?>
<html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width initial-scale=1">
<link rel = "stylesheet" type = "text/css" href = "/css/styles.css">
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
	<div class = "wrapper">
	<div class = "header">
		<h1><a href = '/welcome.php'>Bill Yu</a></h1>
	</div>
	<div class = "aside">
		<div>
			<?php
				if (!isset($_SESSION['login_user'])) {
					echo "<p><a href = '/login.php?postId="
						. $articleId
						. "'>Log In</a></p>";
				}
				else {
					echo "<p><a href = '/logout.php'>Log Out</a></p>";
					if ($_SESSION['login_user'] == $article['author']) {
						echo "<p><a href = '/edit.php?postId="
							. $articleId
							. "'>Edit</a></p>";
					}
				} 
			?>
		</div>
	</div>
	<div class = "content">
		<?php
			echo "<h2><a href = '/article.php?postId=" . $article['id'] . 
 				"'>" . $article['topic'] . "</a></h2>";
		?>
		<div class = "articleInfo">
			<?php
				echo "<p>" . $article['post_time'] . "</p>";
				echo "<p>" . $article['author'] . "</p>";
			?>
		</div>
		<div class = "text">
			<?php
				echo "<pre>" . $article['content'] . "</pre>";
			?>
		</div>
	</div>
<div class = "footer">
	Bill Yu	
</div>
</div>
</body>
</html>	
