<?php
require_once('mantisWrapper.php');
$mw = new mantisWrapper();
if(isset($_GET['projectname'])) {
    $projectID = $mw->getProjectIdFromName($_GET['projectname']);
    isset($projectID) || ! empty($projectID) || die(json_encode( array('error' => "That project doesn't exists!") ));
    echo json_encode(array('result' => $mw->getProjectIssues($projectID), 'version' => $mw->getVersion()) );
}
else if(isset($_GET['getProjects'])) {

}