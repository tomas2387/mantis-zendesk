<?php
isset($_GET['projectname']) || die('No project name!');

$pn = $_GET['projectname'];

require_once('mantisWrapper.php');

$mw = new mantisWrapper();
$projectID = $mw->getProjectIdFromName($pn);

if(!isset($projectID) || empty($projectID)) {
    die(json_encode( array('error' => "That project doesn't exists!") ));
}

$result = $mw->getProjectIssues($projectID);
$version = $mw->getVersion();

echo json_encode(array('result' => $result, 'version' => $version) );
