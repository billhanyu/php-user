<?php
    include('session.php');
?>
<html>
   
   	<head>
    	<title>Welcome </title>
			<meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width initial-scale=1">
			<link rel = "stylesheet" type = "text/css" href = "styles.css">
   	</head>
   
   	<body>
			<div class = "header">
				<h1><a href = "welcome.php">Bill Yu</a></h1>
			</div>
   		<div>
   			<p>You are logged in as <?php echo $login_session; ?></p>
   			<a href = "logout.php">Sign Out</a>
   		</div>
   		<div>
   			<a href = "createPost.php">New Post</a>
   		</div>
			<div class = "content">
   			<div>
   				<?php
						$query = "SELECT * FROM post";
						$retrieval = mysqli_query($db, $query);
						if (! $retrieval) {
							echo "Could not retrieve";
							die('Could not get data: ' . mysql_error());
						}
				
						while ($row = mysqli_fetch_assoc($retrieval)) {
							echo "<h2><a href = 'article.php?postId=" . $row['id'] . 
 								"'>" . $row['topic'] . "</a></h2>";
							echo "<p>" . $row['content'] . "</p>";
						}
					?>	
   			</div>
			</div>
			<div class = "footer">Bill Yu </div>
   	</body>
   
</html>
