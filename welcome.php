<?php
    include('session.php');
?>
<html>
   
   	<head>
    	<title>Welcome </title>
   	</head>
   
   	<body>
   		<div>
   			<p>You are logged in as <?php echo $login_session; ?></p>
   			<a href = "logout.php">Sign Out</a>
   		</div>
   		<div>
   			<a href = "createPost.php">New Post</a>
   		</div>
   		<div>
   			List
   		</div>
   	</body>
   
</html>
