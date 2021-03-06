<?php
include('session.php');
include('functions.php');
$articleId = $_GET['postId'];
$query = "SELECT * FROM post WHERE id = " . $articleId;
$retrieval = mysqli_query($db, $query);
if (! $retrieval) {
	die('Could not get data: ' . mysql_error());
}
$article = mysqli_fetch_assoc($retrieval);
$author = $_SESSION['login_user'];
if ($author != $article['author']) {
	die('Not authorized to edit');	
}
$_SESSION['editTopic'][$articleId] = $article['topic'];
$_SESSION['editContent'][$articleId] = $article['content'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {	
	$topic = $_POST['topic'];
	$_SESSION['editTopic'][$articleId] = $topic;
  $content = $_POST['content'];
	$_SESSION['editContent'][$articleId] = $content;

	$content = filter($content);
	$currentDate = date("M j, Y");
	
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

	if ($canPost) {
		$query = "UPDATE post SET topic = '$topic', content = '$content', post_time = '$currentDate' WHERE id = '$articleId'";
  	$success = mysqli_query($db, $query);
		if (!$success) {
			die('Could not update');
		}
		$_SESSION['editTopic'][$articleId] = "";
		$_SESSION['editContent'][$articleId] = "";
  	header("location: /article.php/?postId=$articleId");
	}
}
?>

<html>
<head>
	<title><?php echo $article['topic'];?></title>
	<link rel = "stylesheet" type = "text/css" href = "/css/bootstrap.min.css">
	<link rel = "stylesheet" type = "text/css" href = "/css/styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src = "/js/bootstrap.min.js"></script>
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
		tinymce.init({
			selector: '.contentBox',
			content_css: '/css/tinyMCE.css'
		});
	</script>
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
			<form action = "" method = "post">
      	<h2>Topic: </h2><br>
      	<textarea name = "topic" class = "topicBox" rows = "1"><?php echo $_SESSION['editTopic'][$articleId];?></textarea><br /><br />
        <h2>Content: </h2><br>
        <textarea name = "content" class = "contentBox" rows = "20"><?php echo $_SESSION['editContent'][$articleId]; ?></textarea><br/><br />
        <input id = "postButton" type = "submit" value = " Repost "/><br />
      </form>
		</div>
		<div class = "footer">
			Bill Yu
		</div>
	</div>
</body>
</html>
