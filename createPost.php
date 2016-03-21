<?php
	include("session.php");

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $topic = $_POST['topic'];
        $content = $_POST['content'];
        $query = "INSERT INTO post (id, topic, content, author, post_time) VALUES (NULL, '$topic', '$content', '$user_id', date('Y-m-d H:i:s'))";
        mysqli_query($db, $query);
        header("location: welcome.php");
	}
?>

<html>
	<head>
		<title>New Post</title>
		<style type = "text/css">
         body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
         }
         
         label {
            font-weight: bold;
            width: 100px;
            font-size: 14px;
         }

         .line {
         	width: 200px;
         	border: #666666 solid 1px;
         }
         
         .box {
         	text-align: left;
    		padding-left:0;
    		padding-top:0;
    		padding-bottom:0.4em;
    		padding-right: 0.4em;
         	height: 200px;
         	width: 200px;
            border: #666666 solid 1px;
         }
      </style>
	</head>

	<body>
		<form action = "" method = "post">
            <label>Topic: </label>
            <input type = "text" name = "topic" class = "line"/><br /><br />
            <label>Content: </label><br>
            <input type = "text" name = "content" class = "box" /><br/><br />
            <input type = "submit" value = " Post "/><br />
        </form>
	</body>
</html>
