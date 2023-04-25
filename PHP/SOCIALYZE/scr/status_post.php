<?php
	session_start();
	include('config.php');
	$ownid = $_SESSION["own_userid"];
	$mestext = $_POST["message_entry"];
	$eintrag = "INSERT INTO tb_status (status_id, status_fromid, status_text) VALUES ('', '$ownid', '$mestext')";
	$eintragen = mysql_query($eintrag);
	header('location: ../index.php');
?>