	<?php
		session_start();
		include('pages/friends/scr/friend_frontend.php');
	?>
	
	<head>
		<link rel='stylesheet' type='text/css' href='pages/friends/css/index.css' />
	</head>
	
	<?php
		echo '
			<div id="content">
				<div id="inner">
		';
		
					li_friends_content();
					
		echo '
				</div>
			</div>
		';
	?>