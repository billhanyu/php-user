<?php
	include("session.php");

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $topic = $_POST['topic'];
        $content = $_POST['content'];
        $query = "INSERT INTO post (id, topic, content, author, post_time) VALUES (NULL, '$topic', '$content', '$user_id', date('Y-m-d H:i:s'))";
        mysqli_query($db, $query);
        header("location: welcome.php");
	}
?>

<html>
	<head>
		<title>New Post</title>
		<link rel	= "stylesheet" type = "text/css" href = "styles.css">
	</head>

	<body>
		<div class = "header">
			<h1><a href = 'welcome.php'>Bill Yu</a></h1>
		</div>
		<div class = "content">
			<form action = "" method = "post">
      	<label>Topic: </label>
      	<input type = "text" name = "topic" class = "line"/><br /><br />
        <label>Content: </label><br>
        <input type = "text" name = "content" class = "box" /><br/><br />
        <input type = "submit" value = " Post "/><br />
      </form>
		</div>
		<div class = "footer">
			Bill Yu
		</div>
	</body>
</html>
