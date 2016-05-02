<?php
include('session.php');
if ($_SERVER["REQUEST_METHOD"] == "GET") {	
	$articleId = $_GET['postId'];
	$query = "SELECT * FROM post WHERE id = " . $articleId;
	$retrieval = mysqli_query($db, $query);
	if (! $retrieval) {
		die('Could not get data: ' . mysql_error());
	}
	$article = mysqli_fetch_assoc($retrieval);
}
else {
	
}
?>

<html>
<head>
	<title><?php echo $article['topic'];?></title>
	<link rel = "stylesheet" type = "text/css" href = "styles.css">
</head>
<body>
	<div class = "header">
		<h1><a href = "welcome.php">Bill Yu</a></h1>
	</div>
	<div class = "center">
			<form action = "" method = "post">
      	<h2>Topic: </h2><br>
      	<input type = "text" name = "topic" class = "topicBox" placeholder = "<?php echo $article['topic'];?>"/><br /><br />
        <h2>Content: </h2><br>
        <textarea name = "content" class = "contentBox" rows = "20">
					<?php echo $article['content']; ?>
				</textarea><br/><br />
        <input id = "postButton" type = "submit" value = " Repost "/><br />
      </form>
		</div>
		<div class = "footer">
			Bill Yu
		</div>
</body>
</html>
