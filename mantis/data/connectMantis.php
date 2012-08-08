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
        return $this->mw->getProjects();
    }

    public function getVersion() {
        return $this->mw->getVersion();
    }
}