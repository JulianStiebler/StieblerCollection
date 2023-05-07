<?php
	$result = mysql_query("SELECT * FROM tb_articles ORDER BY article_time ASC");
	
	while($row = mysql_fetch_row($result))
		echo '
			<div id="article_show">
				<div id="edit_button">
					<form action="edit.php" method="post">
						<input type="text" name="article_select" value="'.$row[0].'" style="display: none;" /> 
						<button class="blue"><span class="icon-edit"> Bearbeiten</span></button>
					</form>
				</div>
				<ul class="article_heading">
					<li class="heading">'.$row[1].'</li>				
					<li class="time">'.$row[2].'</li>
				</ul>
				
				<div class="content">
					<p>
						'.$row[3].'
					</p>
				</div>
			</div>
		';
?>