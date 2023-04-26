<?php
	include('lib/config.php');
	include('lib/builder.php');
	$article_select_ref = $_POST["article_select"];
		
	$result = mysql_query("SELECT * FROM tb_articles WHERE article_id LIKE '$article_select_ref'");
	
	while($row = mysql_fetch_row($result)){
		$article_id = $row[0];
		$article_title = $row[1];
		$article_time = $row[2];
		$article_content = $row[3];
		$article_category = $row[4];
	}
?>
<!DOCTYPE html>
<head>
	<?php
		head_build();
		title_build();
	?>
</head>

<body>
	<div class="container">
	
		<?php
			sidebar_build();
			ucp_build();
		?>
		
		<div class="content">
			<h1>Developer Blog</h1>
			
			<?php
				echo '
				<form action="lib/article/article_update.php" method="post">
					<fieldset id="post_article">
						<legend><span class="icon-edit" style="color: #6cf;"> Artikel bearbeiten</span></legend>
						<input class="input" type="text" name="article_id" value="'.$article_id.'" style="display: none;"/>
						<p>
							<label for="article_title">Titel: </label><br>
							<input class="input" type="text" name="article_new_title" required value="'.$article_title.'" />
						</p>
						<p>
							<label for="article_content">Titel: </label><br>
							<textarea name="article_new_content">'.$article_content.'</textarea>
							<script>CKEDITOR.replace( \'article_new_content\' );</script>
						</p>
						<p>
							<button class="red" name="article_update"><span class="icon-edit"> Speichern</span></button>
							<button class="red" name="article_delete"><span class="icon-trash"> Löschen</span></button>
						</p>
					</fieldset>
				';
			?>
		</div>
	</div>
</body>