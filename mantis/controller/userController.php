<?php

require_once(MANTIS2ZENDESK_ROOT . '/mantis/data/connector.php');

class userController {
    private $cm;

    public function __construct() {
        $this->cm = new connector();
    }

    public function getMantisReporters($projectId)
    {
        $arrayReporters = array();
        $arrayIssues = $this->cm->getIssuesByProjectId($projectId);
        foreach ($arrayIssues as $issue) {
            $arrayReporters[] = $issue['reporter']['name'];
        }
        $arrayReporters = array_unique($arrayReporters);

        return $arrayReporters;
    }

    public function getZendeskReporters()
    {
        return $this->cm->getZendeskReporters();
    }

}
