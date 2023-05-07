<?php
	include('../config.php');
	$article_id = $_POST["article_id_to_del"];
	$query = "DELETE FROM tb_articles WHERE article_time = '$article_id'";
	$doquery = mysql_query($query);
	
	if ($doquery == true){ 
		header('location: ../../index.php?page=articles&action=delete&state=success'); 
	} else {
		header('location: ../../index.php?page=articles&action=delete&state=error');
	}
?>