<?php
	session_start();
	include('lib/builder.php');
	include('lib/config.php');
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
				if (!isset($_GET["page"])){ include('lib/articles.php'); }
				
				if (isset($_GET["page"])){
					if ($_GET["page"] == "gallery"){
						echo '<p>Gallerie</p>';
						return;
					}
					if ($_GET["page"] == "categories"){
						echo '<p>Kategorien</p>';
						return;
					}
					if ($_GET["page"] == "articles"){
						if (isset($_GET["action"])){
							include('lib/articles.php');
							if ($_GET["action"] == "edit"){
								return;
							}
							return;
						}
						
						echo '<p>Artikel</p>';
						return;
					}
					return;
				}
			?>
			
		</div>
	</div>
</body>