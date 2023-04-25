<?php
function li_message_inbox(){
	include('scr/config.php');

	echo '
		<div id="content">
			<div id="inbox">
				<div class="heading">
					<h2>Nachrichten</h2>
				</div>
				
				<div class="side">
					<div class="side_entry">
	';		
				$result = mysql_query("SELECT * FROM tb_profiles");
 
				while($row = mysql_fetch_row($result))
					echo '<a href="index.php?page=messages&showid='.$row[0].'"><p>'.$row[1].' '.$row[2].'</p></a>';
	echo '
					</div>
				</div>
				<div class="message_content">
	';
					li_message_data_person();
	echo '
				</div>
			</div>
		</div>
	';
}

function li_message_data_person(){
	$showid = $_GET["showid"];
	
	$mes_vorname_get = "SELECT profile_vorname FROM tb_profiles WHERE profile_id LIKE '$showid'";
	$mes_vorname_fetch = mysql_query($mes_vorname_get);
	$mes_vorname = mysql_result($mes_vorname_fetch, 0);

	$mes_nachname_get = "SELECT profile_nachname FROM tb_profiles WHERE profile_id LIKE '$showid'";
	$mes_nachname_fetch = mysql_query($mes_nachname_get);
	$mes_nachname = mysql_result($mes_nachname_fetch, 0);

	echo '
		<div class="message_content_head">
				'.$mes_vorname.' '.$mes_nachname.'
		</div>
	';
	
		li_message_show();
		
}

function li_message_show(){
	echo '
		
	';
}
