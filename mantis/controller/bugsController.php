<?php
require_once(MANTIS2ZENDESK_ROOT . '/mantis/data/connector.php');

class bugsController
{
    private $cm;
    public function __construct() {
        $this->cm = new connector();
    }

    public function getMantisBugs($projectName)
    {
        return $this->cm->getIssuesByProjectId($projectName);
    }


}
