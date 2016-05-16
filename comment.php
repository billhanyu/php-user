<?php
	include_once("session.php");
	include_once("functions.php");
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$articleId = $_SESSION['articleId'];
		$content = $_POST['content'];
		$_SESSION['commentContent'][$articleId] = $content;
		$content = filter($content);
		$currentDate = date("M j, Y");
		$author = $_SESSION['login_user'];
		
		if (strlen($content) < 10) {
			header("location: /article.php?postId=$articleId&error=901#newComment");
			die("not long enough");
		}

		if (!$author){
			header("location: /login.php?postId=$articleId");
			die("not logged in");
		}

		$query = "INSERT INTO comment (id, articleId, content, author, post_time) VALUES (NULL, '$articleId', '$content', '$author', '$currentDate')";
		$success = mysqli_query($db, $query);
		if (!$success) {
			die("cannot post comment");
		}
		$_SESSION['commentContent'][$articleId] = "";
		header("location: /article.php?postId=$articleId");
	}

	function getComments($articleId) {
		include("session.php");
		$query = "SELECT * FROM comment where articleId = $articleId";
		$retrieval = mysqli_query($db, $query);
		if (!$retrieval) {
			die("Could not retrieve");
		}
		$commentArray = array();
		while ($comment = mysqli_fetch_assoc($retrieval)) {
			$info = new stdClass;
			$info->content = $comment['content'];
			$info->author = $comment['author'];
			$info->post_time = $comment['post_time'];
			array_push($commentArray, $info);
		}
		return $commentArray;
	}
?>
