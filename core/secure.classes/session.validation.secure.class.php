<?php
	session_start();
	if(!isset($_SESSION['role'])){
		echo "<script> location.href = '/' </script>";
	}
?>