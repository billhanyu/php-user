<?php
include('session.php');
include('functions.php');
$articleId = $_GET['postId'];
$query = "SELECT * FROM post WHERE id = " . $articleId;
$retrieval = mysqli_query($db, $query);
if (! $retrieval) {
	die('Could not get data: ' . mysql_error());
}
$article = mysqli_fetch_assoc($retrieval);
$author = $_SESSION['login_user'];
if ($author != $article['author']) {
	die('Not authorized to edit');	
}
$_SESSION['editTopic'][$articleId] = $article['topic'];
$_SESSION['editContent'][$articleId] = $article['content'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {	
	$topic = $_POST['topic'];
	$_SESSION['editTopic'][$articleId] = $topic;
  $content = $_POST['content'];
	$_SESSION['editContent'][$articleId] = $content;

	$content = filter($content);
	$currentDate = date("M j, Y");
	
	$canPost = true;

	if (strlen($topic) < 1) {
		$canPost = false;
	?>
		<script>alert("Topic is too short.");</script>
	<?php
	}

	if ($canPost && strlen($content) < 20) {
		$canPost = false;
	?>
		<script>alert("Content must be more than 20 characters.");</script>
	<?php
	}

	if ($canPost) {
		$query = "UPDATE post SET topic = '$topic', content = '$content', post_time = '$currentDate' WHERE id = '$articleId'";
  	$success = mysqli_query($db, $query);
		if (!$success) {
			die('Could not update');
		}
		$_SESSION['editTopic'][$articleId] = "";
		$_SESSION['editContent'][$articleId] = "";
  	header("location: /article.php/?postId=$articleId");
	}
}
?>

<html>
<head>
	<title><?php echo $article['topic'];?></title>
	<link rel = "stylesheet" type = "text/css" href = "/css/styles.css">
</head>
<body>
	<div class = "wrapper">
	<div class = "header">
		<h1><a href = "/welcome.php">Bill Yu</a></h1>
	</div>
	<div class = "center">
			<form action = "" method = "post">
      	<h2>Topic: </h2><br>
      	<textarea name = "topic" class = "topicBox" rows = "1"><?php echo $_SESSION['editTopic'][$articleId];?></textarea><br /><br />
        <h2>Content: </h2><br>
        <textarea name = "content" class = "contentBox" rows = "20"><?php echo $_SESSION['editContent'][$articleId]; ?></textarea><br/><br />
        <input id = "postButton" type = "submit" value = " Repost "/><br />
      </form>
		</div>
		<div class = "footer">
			Bill Yu
		</div>
	</div>
</body>
</html>
