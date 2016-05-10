<?php
	include("session.php");
	include("functions.php");
	if (!$_SESSION['login_user']) {
		header("location: /login.php?newPost=true");
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $topic = $_POST['topic'];
				$_SESSION['newPostTopic'] = $topic;
        $content = $_POST['content'];
				$_SESSION['newPostContent'] = $content;
				$content = filter($content);
				$currentDate = date("M j, Y");
				$author = $_SESSION['login_user'];

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

				if (!$author){
					header("location: /login.php?newPost=true");
					$canPost = false;
				}

				if ($canPost) {
        	$query = "INSERT INTO post (id, topic, content, author, post_time) VALUES (NULL, '$topic', '$content', '$author', '$currentDate')";
        	$success = mysqli_query($db, $query);
					$_SESSION['newPostTopic'] = "";
					$_SESSION['newPostContent'] = "";
        	header("location: /welcome.php");
				}
	}
?>

<html>
	<head>
		<title>New Post</title>
		<link rel	= "stylesheet" type = "text/css" href = "css/styles.css">
	</head>

	<body>
		<div class = "wrapper">
		<div class = "header">
			<h1><a href = 'welcome.php'>Bill Yu</a></h1>
		</div>
		<div class = "center">
			<form action = "" method = "post">
      	<h2>Topic: </h2><br>
      	<input type = "text" name = "topic" class = "topicBox" value = "<?php echo $_SESSION['newPostTopic'];?>"/><br /><br />
        <h2>Content: </h2><br>
        <textarea name = "content" class = "contentBox" rows = "20"><?php echo $_SESSION['newPostContent'];?></textarea><br/><br />
        <input id = "postButton" type = "submit" value = " Post "/><br />
      </form>
		</div>
		<div class = "footer">
			Bill Yu
		</div>
		</div>
	</body>
</html>
