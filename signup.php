<?php
	include("config.php");
	session_start();

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$newusername = $_POST["username"];
		$newpassword = md5($_POST["password"]);
		
		$check_username = "SELECT id FROM auth WHERE username = '$newusername'";
		$check_result = mysqli_query($db, $check_username);
		$username_count = mysqli_num_rows($check_result);
		if ($username_count > 0) {
			$error = "Username already exists.";
		}
		else {
			$newuser = "INSERT INTO auth (id, username, passwordhash) VALUES (NULL, '$newusername', '$newpassword')";
			mysqli_query($db, $newuser);
		
			$_SESSION['login_user'] = $newusername;
			echo "heading";
        	header("location: welcome.php");
		}
	}
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width initial-scale=1">
		<title>Signup Page</title>
		<link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/css/user.css">
	</head>
 
	<body>
		<div class = "interval"></div>
		<div class = "window">
		<form action="" method="post">
			<h1>Sign Up</h1>
        
      <fieldset>
        <label for="name">User Name:</label>
        <input type="text" id="name" name="username">
          
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
      </fieldset>
			
			<div class = "error"><?php echo $error;?></div>	
        
      <button type="submit">Sign Up</button>
    </form>
		</div>
	</body>
</html>
