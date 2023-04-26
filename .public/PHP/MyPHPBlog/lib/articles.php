<?php
	include('config.php');
	
	function formular_post_article(){
		if (isset($_GET["state"])){
			if ($_GET["state"] == "success"){
				echo '<p style="color: green;">Artikel erfolgreich eingetragen. <br> <a href="index.php" style="text-decoration: underline; color: green;"><span class="icon-home" style="color: green;"> Zurück</span></a> </p>';
				return;
			}
			if ($_GET["state"] == "error"){
				echo '<p style="color: red;">Fehler beim Eintragen.. <br> <a href="index.php" style="text-decoration: underline; color: red;"><span class="icon-home" style="color: red;"> Zurück</span></a> </p>';
				return;
			}
		}
			
		echo '
			<form action="lib/article/articles_post.php" method="post">
				<fieldset id="post_article">
					<legend><span class="icon-plus" style="color: #6cf;"> Neuer Artikel</span></legend>
					<p>
						<input class="input_art" type="text" name="article_title" required placeholder="Titel des Artikels" />
					</p>
					<p>
						<textarea name="article_content" required style="width: 400px; height: 100px;"></textarea>
						<script>CKEDITOR.replace( \'article_content\' );</script>
					</p>
					<p>
						<button class="red" name="article_post"><span class="icon-check"> Veröffentlichen</span></button>
						<button class="red" type="reset" name="article_clear"><span class="icon-trash"> Daten löschen</span></button>
					</p>
				</fieldset>
			</form>
		';
	}
	function articles_show(){ 
		include('article/articles_show.php'); 
	}
	function formular_delete_article(){
	
		if (isset($_GET["state"])){
			if ($_GET["state"] == "success"){ 
				echo '<p style="color: green;">Löschvorgang erfolgreich. <a href="index.php" style="text-decoration: underline; color: green;"><span class="icon-home" style="color: green;"> Zurück</span></a></p>'; 
			}
			if ($_GET["state"] == "error"){ 
				echo '<p style="color: red;">Löschvorgang fehlgeschlagen. <a href="index.php" style="text-decoration: underline; color: red;"><span class="icon-home" style="color: red;"> Zurück</span></a></p>'; 
			}
			return;
		}
		echo '
		<form action="lib/article/articles_delete.php" method="post">
			<fieldset id="post_article">
				<legend><span class="icon-trash" style="color: #6cf;"> Artikel löschen</span></legend>
				<p>
					<label for="">Uhrzeit des Artikels: </label><br>
					<input class="input" type="text" name="article_id_to_del" required />
				</p>
				<p><button class="red" type="submit" name="article_delete"><span class="icon_trash"> Löschen</span></button></p>
			</fieldset>
		</form>
		';
	}
	function formular_edit_article(){
		if (isset($_GET["page"])){
			if (isset($_GET["action"])){	
				if (isset($_GET["method"])){
					if ($_GET["method"] == "delete"){
						if (isset($_GET["state"])){
							if ($_GET["state"] == "success"){
								echo '<p style="color: green;">Artikel erfolgreich gelöscht. <br> <a href="index.php" style="text-decoration: underline; color: green;"><span class="icon-home" style="color: green;"> Zurück</span></a> </p>';
								return;
							}
							if ($_GET["state"] == "error"){
								echo '<p style="color: red;">Fehler beim Löschvorgang. <br> <a href="index.php" style="text-decoration: underline; color: red;"><span class="icon-home" style="color: red;"> Zurück</span></a> </p>';
								return;
							}
						}
					}
					if ($_GET["method"] == "update"){
						if (isset($_GET["state"])){
							if ($_GET["state"] == "success"){
								echo '<p style="color: green;">Artikel erfolgreich editiert. <br> <a href="index.php" style="text-decoration: underline; color: green;"><span class="icon-home" style="color: green;"> Zurück</span></a> </p>';
								return;
							}
							if ($_GET["state"] == "error"){
								echo '<p style="color: red;">Fehler beim Editieren. <br> <a href="index.php" style="text-decoration: underline; color: red;"><span class="icon-home" style="color: red;"> Zurück</span></a> </p>';
								return;
							}
						}
					}
				}
			}
		}
		echo '
			<form action="edit.php" method="post">
				<input type="text" name="article_select" required/>
				<button class="red" name="article_select_submit"><span class="icon_edit"> Auswählen</span></button>
			</form>
		';
	}
	
	if(isset($_GET["page"])){
		if ($_GET["page"] == "articles"){
			if(isset($_GET["action"])){
				if ($_GET["action"] == "new"){
					formular_post_article();
					return;
				}
				if ($_GET["action"] == "edit"){
					formular_edit_article();
				}
			}
			
		}
	}
	
	if(!isset($_GET["page"]) or !isset($_GET["action"]) or !isset($_GET["state"])){
		articles_show();
	}

?>