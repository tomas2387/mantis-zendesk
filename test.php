<?
include_once('settings.php');
require_once(NUSOAP);
$soapclient = new nusoap_client(ENDPOINT);

$version = $soapclient->call( 'mc_version', array() );
?>
<!DOCTYPE html>
<html>
<head>
	<style>
		body {
			background-color: lightgray;
		}

		.version {
			color: gray; font-family: Helvetica; font-size: 9px;
		}

		.container {
			background-color:#ffffff; 
	    	text-align:left; 
			overflow:hidden;
			padding: 2%;
	    	
			
			-webkit-border-radius: 10px; 
			-moz-border-radius: 10px;
			border-radius: 10px;
			
			border: 1px solid #aaa; 
	        
	        font-family: Helvetica;
			font-size:14px;
			color: #333;
			
			-moz-box-shadow: 0px 2px 4px 1px #aaa;
			-webkit-box-shadow: 0px 2px 4px 1px #aaa;
			box-shadow: 0px 2px 4px 1px #aaa;
		}

		.centered-container {
			width: 90%;
			margin:0 auto;
		}

		.logo-eyeos {
		}
	</style>
</head>
<body>
<div class="centered-container">
	<div class="container">
		<div class="logo-eyeos">
			<img src="http://resources.eyeos.org/partners/logoclaim.png" width="200" height="43" />
		</div>
		<?php
			/* Get Mantis Issues 
				username: xsd:string
			    password: xsd:string
			    project_id: xsd:integer
			    page_number: xsd:integer
			    per_page: xsd:integer
			*/
			$result = $soapclient->call( 'mc_project_get_issues', 
									array(
										'username' => 'administrator',
										'password' => 'root',
										'project_id' => '1',
										'page_number' => '',
										'per_page' => ''

										) );

			

			echo '<pre>';
			print_r($result);
			echo '</pre>';



		?>
	</div>
	<div class="version">
		Mantis Connect version: <?=$version ?>
	</div>
</div>
</body>
</html>