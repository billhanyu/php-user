<?php
	include("session.php");

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $topic = $_POST['topic'];
        $content = $_POST['content'];
				$currentDate = date("M j, Y");
				$author = $_SESSION['login_user'];
        $query = "INSERT INTO post (id, topic, content, author, post_time) VALUES (NULL, '$topic', '$content', '$author', '$currentDate')";
        $success = mysqli_query($db, $query);
				fwrite($handle, $success);
        header("location: welcome.php");
	}
?>

<html>
	<head>
		<title>New Post</title>
		<link rel	= "stylesheet" type = "text/css" href = "css/styles.css">
	</head>

	<body>
		<div class = "header">
			<h1><a href = 'welcome.php'>Bill Yu</a></h1>
		</div>
		<div class = "center">
			<form action = "" method = "post">
      	<h2>Topic: </h2><br>
      	<input type = "text" name = "topic" class = "topicBox"/><br /><br />
        <h2>Content: </h2><br>
        <textarea name = "content" class = "contentBox" rows = "20"></textarea><br/><br />
        <input id = "postButton" type = "submit" value = " Post "/><br />
      </form>
		</div>
		<div class = "footer">
			Bill Yu
		</div>
	</body>
</html>
