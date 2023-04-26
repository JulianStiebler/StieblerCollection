<?php
	include('../config.php');
	$article_select_ref = $_POST["article_select"];
		
	$result = mysql_query("SELECT * FROM tb_articles WHERE article_time LIKE '$article_select_ref'");
	
	while($row = mysql_fetch_row($result)){
		$article_id = $row[0];
		$article_title = $row[1];
		$article_time = $row[2];
		$article_content = $row[3];
		$article_category = $row[4];
	}
	
	echo '<!DOCTYPE html><head>';
		include('page/headsection.php'); 
		echo '<title>Developers Blog</title>';
	echo '</head><body><div class="container">';
		include('page/sidebar.php'); 
		include('page/ucp.php'); 
	echo '<div class="content"><h1>Developer Blog</h1>';
	echo '
	<form action="article
		<fieldset id="post_article">
			<legend><span class="icon-edit" style="color: #6cf;"> Artikel bearbeiten</span></legend>
			<p>
				<label for="article_title">Titel: </label><br>
				<input class="input" type="text" name="article_new_title" required value="'.$article_title.'" />
			</p>
			<p>
				<label for="article_category">Titel: </label><br>
				<input class="input" type="text" name="article_new_category" required />
			</p>
			<p>
				<label for="article_content">Titel: </label><br>
				<textarea name="article_new_content" required style="width: 400px; height: 100px;"></textarea>
						<script>CKEDITOR.replace( \'article_new_content\' );</script>
			</p>
			<p>
				<button class="red" name="article_update"><span class="icon-edit"> Speichern</span></button>
				<button class="red" name="article_delete"><span class="icon-trash"> Löschen</span></button>
			</p>
		</fieldset>
	';
	echo '</div></div></body>';
?>