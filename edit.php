<?php
include('session.php');
$articleId = $_GET['postId'];
$query = "SELECT * FROM post WHERE id = " . $articleId;
$retrieval = mysqli_query($db, $query);
if (! $retrieval) {
	die('Could not get data: ' . mysql_error());
}
$article = mysqli_fetch_assoc($retrieval);

if ($_SERVER["REQUEST_METHOD"] == "POST") {	
	$topic = $_POST['topic'];
  $content = $_POST['content'];
	$currentDate = date("M j, Y");
	$author = $_SESSION['login_user'];
	if ($author != $article['author']) {
		die('Not authorized to edit');	
	}
	$query = "UPDATE post SET topic = '$topic', content = '$content', post_time = '$currentDate' WHERE id = '$articleId'";
  $success = mysqli_query($db, $query);
	if (!$success) {
		die('Could not update');
	}
  header("location: article.php/?postId=$articleId");
}
?>

<html>
<head>
	<title><?php echo $article['topic'];?></title>
	<link rel = "stylesheet" type = "text/css" href = "css/styles.css">
</head>
<body>
	<div class = "header">
		<h1><a href = "welcome.php">Bill Yu</a></h1>
	</div>
	<div class = "center">
			<form action = "" method = "post">
      	<h2>Topic: </h2><br>
      	<textarea name = "topic" class = "topicBox" rows = "1"><?php echo $article['topic'];?></textarea><br /><br />
        <h2>Content: </h2><br>
        <textarea name = "content" class = "contentBox" rows = "20"><?php echo $article['content']; ?></textarea><br/><br />
        <input id = "postButton" type = "submit" value = " Repost "/><br />
      </form>
		</div>
		<div class = "footer">
			Bill Yu
		</div>
</body>
</html>
