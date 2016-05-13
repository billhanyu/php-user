<?php
	include('session.php');
	$articleId = $_GET['postId'];

	$query = "SELECT * FROM post WHERE id = " . $articleId;
	$retrieval = mysqli_query($db, $query);
	if (! $retrieval) {
		echo 2;
		die('Post not Found.');
	}
	$article = mysqli_fetch_assoc($retrieval);
	if ($_SESSION['login_user'] != $article['author']) {
		echo 3;
		die("Not Authorized.");
	}

	$query = "DELETE FROM post WHERE id = '$articleId'";
	$deletePost = mysqli_query($db, $query);
	if (!$deletePost) {
		echo 4;
		die("Post not Found.");
	}
	$query = "DELETE FROM comment WHERE articleId = '$articleID'";
	$deleteComments = mysqli_query($db, $query);
	echo 1;
?>
