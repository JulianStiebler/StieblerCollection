<?php
	include('../config.php');
	$timestamp = time();
	$datum = date("d.m.Y",$timestamp);
	$uhrzeit = date("H:i",$timestamp);
	$article_time = $datum." - ".$uhrzeit." Uhr";
	$article_title = $_POST["article_title"];
	$article_content = $_POST["article_content"];
	$article_category = $_POST["article_category"];
	
	$query = "INSERT INTO tb_articles (article_id, 	article_title, article_time, article_content, article_category) VALUES ('', '$article_title', '$article_time', '$article_content' , '$article_category')";
	$doquery = mysql_query($query);
	
	if ($doquery == true){ 
		header('location: ../../index.php?page=articles&action=new&state=success'); 
	} else {
		header('location: ../../index.php?page=articles&action=new&state=error');
	}
?>