<?php
	function head_build(){
		include('page/headsection.php');
	}
	
	function title_build(){
		echo "<title>Developer's Blog</title>";
	}
	
	function sidebar_build(){
		include('page/sidebar.php');
	}
	
	function ucp_build(){
		include('page/ucp.php');
	}
	
	function register_page(){
		include('page/register.php');
	}
?>