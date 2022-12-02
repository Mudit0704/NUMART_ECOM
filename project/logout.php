<?php
	
	session_start();
	
	session_destroy();
	
	header("location: admin.php?msg=You have successfully logged out!");

?>