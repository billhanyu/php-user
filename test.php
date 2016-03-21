<?php
	include ("config.php");
	$query = "INSERT INTO auth (id, username, passwordhash) VALUES (NULL, 'shit', 'oeiwfjew')";
	mysqli_query($db, $query);
?>
