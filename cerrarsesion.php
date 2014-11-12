<?php
	@session_start();	
	require_once('inc/conex.php');

	@session_destroy();
	header('location:index.php');
?>