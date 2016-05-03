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
				header("location: article.php?postId=" . $fromArticle);
			}
			else {
				header("location: welcome.php");
			}
		}
		else {
			$error = "Your Login Name or Password is invalid";
		}
	}
?>

<html>
   
   <head>
      <title>Login Page</title>
   </head>
   
   <body>
	
      <div>
         <div>
            <div><b>Login</b></div>
				
            <div>
               
               <form action = "" method = "post">
                  <label>Username: </label><input type = "text" name = "username"/><br /><br />
                  <label>Password: </label><input type = "password" name = "password"/><br/><br />
                  <input type = "submit" value = " Go "/><br />
               </form>
               
               <div><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>
