<?php

function li_wrapper_content(){
	include('scr/config.php');
	echo '
		<div id="content">
			<div id="status_entry_head">
				<h2>Aktuelle Geschehnisse -- <a href="index.php?action=status" style="color: #0066ff; text-decoration: none;">Eigenen Status posten</a></h2>
			</div>
			<div id="status_content">
	';
	
	if ($_GET["action"] == "status"){
		echo '<form action="scr/status_post.php" method="post"><input type="text" name="message_entry" placeholder="Statustext..." /> </textarea> 
				<input type="submit" name="status_post" value="Posten" /></form>';
		echo '</div>';
		exit;
	}
			
	$result = mysql_query("SELECT * FROM tb_status ORDER BY status_id DESC");
	
	while($row = mysql_fetch_row($result))
		echo '
			<div id="status_entry">
				<p>Status_ID: '.$row[0].' von User_ID '.$row[1].' mit Inhalt: <br> '.$row[2].'
			</div>
		';
	
	echo '</div></div>';
}

/*
$result = mysql_query("SELECT * FROM tb_status");
	
	while($row = mysql_fetch_row($result))
		echo '
			<div id="status_entry">
				<p>Status_ID: '.$row[0].' von '.$row[1].' mit Inhalt: <br> '.$row[2].'
			</div>
		';
*/

?>
