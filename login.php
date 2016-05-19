<?php
	include("config.php");
	session_start();
	$fromArticle = -1;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = md5(mysqli_real_escape_string($db, $_POST['password']));
		$sql = "SELECT id FROM auth WHERE username = '$myusername' and passwordhash = '$mypassword'";	
		$result = mysqli_query($db, $sql);
		$count = mysqli_num_rows($result);

		if ($count == 1) {
			$_SESSION['login_user'] = $myusername;
			$fromArticle = $_GET['postId'];
			if ($fromArticle) {
				header("location: /article.php?postId=" . $fromArticle);
			}
			else if ($_GET['newPost']) {
				header("location: /createPost.php");
			}
			else {
				header("location: /welcome.php");
			}
		}
		else {
			$error = "Your Login Name or Password is invalid";
		}
	}
?>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width initial-scale=1">
		<title>Login Page</title>
		<link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/user.css">
	</head>
   
	<body>	
		<div class = "interval"></div>
		<div class = "window">
		<form action="" method="post">
      <h1>Log In</h1>
       
			<fieldset>
        <label for="name">User Name:</label>
        <input type="text" id="username" name="username">
          
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
      </fieldset>
        
			<div class = "error"><?php echo $error;?></div>
      <button type="submit">Log In</button>
    </form>
		<form action="/signup.php" method="get">
			<button type = "submit" id="signup">Sign Up</button>
		</form>
		</div>
	</body>
</html>
