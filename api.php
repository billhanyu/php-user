<?php
include("session.php");
include("response.php");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if ($_GET["request"] == "post") {
		if ($_GET["given"] == "id") {
			if ($_GET["id"] == "all") {
				//?request=post&given=id&id=all -- return all posts
				$query = "SELECT * from post ORDER BY id DESC";
				$retrieval = mysqli_query($db, $query);
				echo json_encode(postArrayWithRetrieval($retrieval));
			}
			else {
				//?request=post&given=id&id={id} -- return post with id
				$articleId = $_GET["id"];
				$query = "SELECT * from post WHERE id = $articleId";
				$retrieval = mysqli_query($db, $query);
				echo json_encode(postArrayWithRetrieval($retrieval)[0]);
			}
		}
		else if ($_GET["given"] == "author") {
			//?request=post&given=author&author={name}
			$author = $_GET["author"];
			$query = "SELECT * from post WHERE author = '$author' ORDER BY id DESC";
			$retrieval = mysqli_query($db, $query);
			echo json_encode(postArrayWithRetrieval($retrieval));
		}
	}
	else if ($_GET["request"] == "comment") {
		if ($_GET["given"] == "author") {
			//?request=comment&given=author&author={name}
			$author = $_GET["author"];
			$query = "SELECT * FROM comment WHERE author = '$author' ORDER BY id DESC";
			$retrieval = mysqli_query($db, $query);
			echo json_encode(commentArrayWithRetrieval($retrieval));
		}
		else if ($_GET["given"] == "postId") {
			//?request=comment&given=postId&postId={id}
			$articleId = $_GET["postId"];
			$query = "SELECT * FROM comment WHERE articleId = $articleId ORDER BY id DESC";
			$retrieval = mysqli_query($db, $query);
			echo json_encode(commentArrayWithRetrieval($retrieval));
		}
	}
}

function postArrayWithRetrieval($retrieval) {
	if (!$retrieval) {
		http_response_code(404);
		die("Could not retrieve");
	}
	$posts = array();
	while ($article = mysqli_fetch_assoc($retrieval)) {
		$t = new stdClass;
		$t->id = $article['id'];
		$t->topic = $article['topic'];
		$t->content = $article['content'];
		$t->author = $article['author'];
		$t->post_time = $article['post_time'];
		array_push($posts, $t);
	}
	return $posts;
}

function commentArrayWithRetrieval($retrieval) {
	if (!$retrieval) {
		http_response_code(404);
		die("Could not retrieve");
	}
	$comments = array();
	while ($comment = mysqli_fetch_assoc($retrieval)) {
		$t = new stdClass;
		$t->id = $comment['id'];
		$t->articleId = $comment['articleId'];
		$t->author = $comment['author'];
		$t->content = $comment['content'];
		$t->post_time = $comment['post_time'];
		array_push($comments, $t);
	}
	return $comments;
}
?>
