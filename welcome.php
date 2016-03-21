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
   			<?php
				$query = "SELECT * FROM post";
				$retrieval = mysqli_query($db, $query);
				if (! $retrieval) {
					echo "Could not retreve";
					die('Could not get data: ' . mysql_error());
				}
				
				while ($row = mysqli_fetch_assoc($retrieval)) {
					echo $row['topic'] . "<br>".
					$row['content'] . "<br>".
					"-------------------------<br>";
				}
			?>	
   		</div>
   	</body>
   
</html>
