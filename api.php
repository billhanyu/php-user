<?php
include("session.php");
include("response.php");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if ($_GET["request"] == "post") {
		if ($_GET["number"] == "all") {
			$query = "SELECT * from post ORDER BY id DESC";
			$retrieval = mysqli_query($db, $query);
			if (!$retrieval) {
				http_response_code(404);
				die("Could not retrieve");
			}
			$posts = array();
			while ($article = mysqli_fetch_assoc($retrieval)) {
				$t = new stdClass;
				$t->id = $article['id'];
				$t->content = $article['content'];
				$t->author = $article['author'];
				$t->post_time = $article['post_time'];
				array_push($posts, $t);
			}
			echo json_encode($posts);
		}
		else {
			$articleId = $_GET["number"];
			$query = "SELECT * from post WHERE id = $articleId";
			$retrieval = mysqli_query($db, $query);
			if (!$retrieval) {
				http_response_code(404);
				die("Article not found");
			}
			$article = mysqli_fetch_assoc($retrieval);
			echo json_encode($article);
		}
	}
}
?>
