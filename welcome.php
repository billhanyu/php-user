<?php
    include('session.php');
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
						$query = "SELECT * FROM post ORDER BY id DESC";
						$retrieval = mysqli_query($db, $query);
						if (! $retrieval) {
							echo "Could not retrieve";
							die('Could not get data: ' . mysql_error());
						}

						$num_articles = mysqli_num_rows($retrieval);
						$count = 0;
				
						while ($article = mysqli_fetch_assoc($retrieval)) {
							$count++;
							echo "<h2><a href = '/article.php?postId=" . $article['id'] . 
 								"'>" . $article['topic'] . "</a></h2>";
					?>
					<div class = "articleInfo">
						<?php
							echo "<p>" . $article['post_time'] . "</p>";
							echo "<p>" . $article['author'] . "</p>";
						?>
					</div>
					<div class = "text">
						<?php
							echo "<pre>" . $article['content'] . "</pre>";
						?>
					</div>
					<?php
							if ($count < $num_articles) {
								echo "<div class = 'interval'><p><br><br></p></div>";
							}
						}
					?>	
			</div>
			<div class = "footer">Bill Yu</div>
   	</body>
   
</html>
