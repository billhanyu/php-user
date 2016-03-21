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
      <title>Signup Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Signup</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>
