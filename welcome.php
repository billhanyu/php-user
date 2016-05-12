<?php
	include('session.php');
	include('comment.php');
?>
<html>
   
   	<head>
    	<title>Welcome </title>
			<meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width initial-scale=1">
			<link rel = "stylesheet" type = "text/css" href = "/css/styles.css">
   	</head>
   
   	<body>
			<div class = "wrapper">
			<div class = "header">
				<h1><a href = "/welcome.php">Bill Yu</a></h1>
			</div>
			<div class = "aside">
   			<div>
					<?php
						if(isset($_SESSION['login_user'])){
					?>
   				<p>You are logged in as <?php echo $login_session; ?></p>
					<p><a href = "/logout.php">Log Out</a></p>
					<p><a href = "/createPost.php">New Post</a></p>	
					<?php
						} else {
					?>
					<p><a href = "/login.php">Log In</a></p>
					<p><a href = "/signup.php">Sign Up</a></p>
					<?php
						}
					?>
   			</div>
			</div>
			<div class = "content">
   				<?php
						$pageIndex = $_GET['page'];
						$query = "SELECT * FROM post ORDER BY id DESC";
						if (!$pageIndex) $pageIndex = 1;
						$pageQuery = $query . " LIMIT " . ($pageIndex-1) * $articles_per_page . ", " . $articles_per_page;
						$retrieval = mysqli_query($db, $query);
						if (! $retrieval) {
							echo "Could not retrieve";
							die('Could not get data: ' . mysql_error());
						}

						$num_articles = mysqli_num_rows($retrieval);
						$pages = ($num_articles - 1) / $articles_per_page + 1;
						$count = 0;

						if ($pageQuery) {
							$retrieval = mysqli_query($db, $pageQuery);
							if (!$retrieval) {
								die('Could not get data: ' . mysql_error());
							}
						}
				
						while ($article = mysqli_fetch_assoc($retrieval)) {
							$count++;
							echo "<h2><a href = '/article.php?postId=" . $article['id'] . 
 								"'>" . $article['topic'] . "</a></h2>";
					?>
					<div class = "text">
						<?php
							echo "<pre>" . $article['content'] . "</pre>";
						?>
					</div>
					<div class = "articleInfo">
						<?php
							echo "<div id='info'>" . $article['author'] . "</div>";
							echo "<div id='info'>" . $article['post_time'] . "</div>";
							$articleId = $article['id'];
							$num_comments = count(getComments($articleId));
							if ($num_comments == 0) {
								echo "<div id='info'><a href = '/article.php?postId=$articleId#newComment'>Leave a comment</a></div>";
							}
							else {
								echo "<div id='info'><a href = '/article.php?postId=$articleId#comments'>Comments($num_comments)</a></div>";
							}
						?>
					</div>
					<?php
							if ($count < $articles_per_page && ($count + ($pageIndex - 1) * $articles_per_page) < $num_articles) {
								echo "<div class = 'interval'></div>";
							}
						}
					?>	
			</div>
			<div class = "pages">
				<?php
					for ($i = 1; $i <= $pages; $i++) {
						if ($i == $pageIndex) {
							echo "<a id='currentPage' href = '/welcome.php?page=$i'>$i</a>";
						}
						else {
							echo "<a id='otherPage' href = '/welcome.php?page=$i'>$i</a>";
						}
					}
				?>
			</div>
			<div class = "footer">Bill Yu</div>
			</div>
   	</body>
   
</html>
