<?php
require_once('mantisWrapper.php');

class connectMantis {
    private $mw;

    public function __construct() {
        $this->mw = new mantisWrapper();
    }

    public function getIssues($projectName) {
        $projectID = $this->mw->getProjectIdFromName($_GET['projectName']);
        if( ! isset($projectID) || empty($projectID)) return json_encode( array('error' => "That project doesn't exists!") );

        return $this->mw->getProjectIssues($projectID);
    }

    public function getProjects() {
        $projects = $this->mw->getProjects();
        return $projects;
    }

    public function getVersion() {
        return $this->mw->getVersion();
    }
};


$cm = new connectMantis();
if(isset($_GET['projectName'])) {
    echo json_encode( array('result' => $cm->getIssues($_GET['projectName']), 'version' => $cm->getVersion()) );
}
else if(isset($_GET['getProjects'])) {
    echo json_encode(array('results' => $cm->getProjects()));
}