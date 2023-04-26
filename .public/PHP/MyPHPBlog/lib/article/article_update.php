<?php
	include('../config.php');
	if (isset($_POST["article_update"])){
		$article_id = $_POST["article_id"];
		$article_title = $_POST["article_new_title"];
		$article_category = $_POST["article_new_category"];
		$article_content = $_POST["article_new_content"];
		
		$query = "UPDATE tb_articles SET article_title = '$article_title', article_content = '$article_content', article_category = '$article_category' WHERE article_id = '$article_id'";
		$doquery = mysql_query($query);
		
		if ($doquery == true){
			header('location: ../../index.php?page=articles&action=edit&method=update&state=success');
		} else {
			header('location: ../../index.php?page=articles&action=edit&method=update&state=error');
		}
	}
	if (isset($_POST["article_delete"])){
		$article_id = $_POST["article_id"];
		$query = "DELETE FROM tb_articles WHERE article_id = '$article_id'";
		$doquery = mysql_query($query);

		if ($doquery == true){
			header('location: ../../index.php?page=articles&action=edit&method=delete&state=success');
		} else {
			header('location: ../../index.php?page=articles&action=edit&method=delete&state=error');
		}
	}
?>