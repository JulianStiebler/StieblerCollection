<?php
function profiler_from_id(){

	include('scr/config.php');
	$profile_showid = $_GET["id"];
	$result = mysql_query("SELECT * FROM tb_profiles WHERE profile_id = '$profile_showid'");
	$row = mysql_fetch_row($result);
		
		$profile_id = $row[0];
		$profile_vorname = $row[1];
		$profile_nachname = $row[2];
		$profile_wohnort = $row[3];
		$profile_name = $profile_vorname.' '.$profile_nachname;
		
		if ($profile_vorname == "" or $profile_nachname == "" or $profile_wohnort == ""){
			echo '
				<div id="content">
					<h2 style="text-indent: 20px;">Sie haben ein fehlerhaftes Profil aufgerufen. <a href="#" onclick="javascript:history.go(-1);">&laquo; Zur&uuml;ck</a>.</h2>
				</div>
			';
			exit;
		}
		
		if ($_GET["content"] == "gallery"){
			echo '
				<div id="content">
					<h2 style="text-indent: 20px;">Bilder von '.$profile_name.'</h2>
				</div>
			';
			exit;
		}
		
		if ($_GET["content"] == "friends"){
			echo '
				<div id="content">
					<h2 style="text-indent: 20px;">Freunde von '.$profile_name.'</h2>
				</div>
			';
			exit;
		}
		
		if ($_GET["action"] == "add_friend"){
			$ownid = $_SESSION["own_userid"];
			
			$eintrag = "INSERT INTO tb_friends(
				friend_id, friend_userid, friend_withid, friend_state, friend_seen, friend_ingroup, friend_name)
			VALUES
				('', '$ownid', '$profile_showid', '1', '1', '0', '$profile_name')";

			$eintragen = mysql_query($eintrag);
		}
	
	echo '
		<div id="content">
			<div id="content_head">
				<h2 class="text">Profil von '.$profile_name.'</h2>
			</div>
			
			<div id="content_side">
				<div class="profilbild">
					
				</div>
				
				<div class="stadt_pos">
					<p>Aus '.$profile_wohnort.'</p>
				</div>
				
				<div class="entry">
					<a href="profile.php?id='.$profile_showid.'&content=gallery"><p>Gallerie</p></a>
				</div>
				
				<div class="entry">
					<a href="profile.php?id='.$profile_showid.'&content=friends"><p>Freunde von '.$profile_vorname.'</p></a>
				</div>
				
				<div class="entry">
					<a href="profile.php?action=add_friend&id='.$profile_showid.'"><p>Freund hinzuf&uuml;gen</p></a>
				</div>
			</div>
			
			<div id="content_inner">
				<table id="statustable">
					<thead>
						<td><div class="profilbild_thumb"></div>'.$profile_name.'</td>
					</thead>
					<tbody>
						<tr>
							<td style="font-size: 14px;">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea.</td>
						</tr>
					</tbody>
				</table>
				
				<table id="statustable">
					<thead>
						<td><div class="profilbild_thumb"></div>'.$profile_name.'</td>
					</thead>
					<tbody>
						<tr>
							<td style="font-size: 14px;">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea.</td>
						</tr>
					</tbody>
				</table>
				
				<table id="statustable">
					<thead>
						<td><div class="profilbild_thumb"></div>'.$profile_name.'</td>
					</thead>
					<tbody>
						<tr>
							<td style="font-size: 14px;">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea.</td>
						</tr>
					</tbody>
				</table>
				
				<table id="statustable">
					<thead>
						<td><div class="profilbild_thumb"></div>'.$profile_name.'</td>
					</thead>
					<tbody>
						<tr>
							<td style="font-size: 14px;">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea.</td>
						</tr>
					</tbody>
				</table>
				
				<table id="statustable">
					<thead>
						<td><div class="profilbild_thumb"></div>'.$profile_name.'</td>
					</thead>
					<tbody>
						<tr>
							<td style="font-size: 14px;">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea.</td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
	';
}

?>