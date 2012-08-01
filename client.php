<?php
if( !isset($_GET['projectname']) ) {
	die('No project name!');
}


$pn = $_GET['projectname'];

include_once('settings.php');
require_once(NUSOAP);
$soapclient = new nusoap_client(ENDPOINT);

$version = $soapclient->call( 'mc_version', array() );

$projectID = $soapclient->call( 'mc_project_get_id_from_name', 
									array(
										'username' => 'administrator',
										'password' => 'root',
										'project_name' => $pn
										) );

if(!isset($projectID) || empty($projectID)) {
	die(json_encode( array('error' => "That project doesn't exists!") ));
}

$result = $soapclient->call( 'mc_project_get_issues', 
							array(
								'username' => 'administrator',
								'password' => 'root',
								'project_id' => $projectID,
								'page_number' => '',
								'per_page' => ''
								) );
echo json_encode(array('result' => $result, 'version' => $version) );
			