<!DOCTYPE html>
<?php
include('session.php');
include('comment.php');
?>
<html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {	
	$articleId = $_GET['postId'];
	$_SESSION['articleId'] = $articleId;
	$commentContent = $_SESSION['commentContent'][$articleId];
	
	if ($_GET['error'] == 901) {
	?>
		<script>
			alert("Comment must be more than 10 characters long");
		</script>
	<?php
	}

	$query = "SELECT * FROM post WHERE id = " . $articleId;
	$retrieval = mysqli_query($db, $query);
	if (! $retrieval) {
		die('Could not get data: ' . mysql_error());
	}
	$article = mysqli_fetch_assoc($retrieval);
}
?>

<head>
	<title><?php echo $article['topic']?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width initial-scale=1">
	<link rel = "stylesheet" type = "text/css" href = "/css/bootstrap.min.css">
	<link rel = "stylesheet" type = "text/css" href = "/css/styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src = "/js/bootstrap.min.js"></script>

</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/welcome.php">Bill Yu</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<?php
				if(isset($_SESSION['login_user'])){
			?>
   				<p class = "navbar-text">You are logged in as <?php echo $login_session; ?></p>
					<ul class = "nav navbar-nav navbar-right">
						<li><a href = "/logout.php">Log Out</a></li>
						<li><a href = "/createPost.php">New Post</a></li>
						<?php
							if ($_SESSION['login_user'] == $article['author']) {
								echo "<li><a href = '/edit.php?postId=$articleId'>Edit</a></li>";
								echo "<li><a href = 'javascript:confirmDelete();'>Delete</a></li>";
							}
						?>
					</ul>
			<?php
				} else {
			?>
					<ul class = "nav navbar-nav navbar-right">
						<li><a href = "/login.php">Log In</a></li>
						<li><a href = "/signup.php">Sign Up</a></li>
					</ul>
			<?php
				}
			?>
   </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

	<div class = "wrapper">
	<div class = "content">
		<?php
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
			?>
		</div>
	</div>
	<div class = "interval"></div>
	<div id = "comments">
		<?php 
			$commentArray = getComments($articleId);
			if (count($commentArray) > 0) {
				echo "<h3>Comments</h3>";
			}
			for ($i = 0; $i < count($commentArray); $i++) {
		?>
				<div id = "piece">
					<div class = "text">
						<?php
							echo "<pre id='commentContent'>" . $commentArray[$i]->content . "</pre>";
						?>
					</div>
					<div class = "articleInfo">
						<?php
							echo "<div id='commentInfo'>" . $commentArray[$i]->author . "</div>";
							echo "<div id='commentInfo'>" . $commentArray[$i]->post_time . "</div>";
						?>
					</div>
				</div>
		<?php		
			}
			if (count($commentArray) > 0) {
				echo "<div class = 'interval'></div>";
			}
		?>
	</div>
	<div id = "newComment">
		<h3 style = "clear: both;">New Comment</h3>
		<form action = "/comment.php" method = "post">
			<textarea name = "content" class = "editComment" rows="10"><?php echo $commentContent?></textarea>
			<input id = "postComment" type = "submit" value = "Comment">
		</form>
	</div>
<div class = "footer">
	Bill Yu	
</div>
</body>
</html>	

<script type="text/javascript">
	function confirmDelete() {
		if (confirm('Are you sure you want to delete this?')) {
			$.ajax({
				url: "/delete.php",
				type: "GET",
				data: {postId : <?php echo $articleId;?>},
				dataType: "html", 
				success: function(response) {
					if (response == 1) {
						window.location.href = "/welcome.php";
					}
					else if (response == 2) {
						alert("No Post Found.");
					}
					else if (response == 3) {
						alert("Not Authorized.");
					}
					else {
						alert("Unknown Error.");
					}
				}
			});
		}
	}
</script>
