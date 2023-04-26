<?php
function li_friends_content(){
	include('scr/config.php');
	
	$own_userid = $_SESSION["own_userid"];
	
	$result = mysql_query("SELECT * FROM tb_friends WHERE friend_userid LIKE '$own_userid' AND friend_state LIKE '1'");
	
	while($row = mysql_fetch_row($result))
			echo '
				<div id="friendbox">			
					<a href="profile.php?id='.$row[2].'">
						<p>'.$row[6].'<br></p>
					</a>
						
					<div id="friendbox_buttons">
							<a href="index.php?page=settings&action=friends&do=delete&id='.$row[0].'">Freund entfernen</a>
							-
							<a href="index.php?page=settings&mode=account&content=groups&mark='.$row[2].'">Freund gruppieren</a>
					</div>
				</div>
			';
}

?>