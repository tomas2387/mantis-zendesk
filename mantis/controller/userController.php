<?php
require_once __DIR__ . '/../data/connector.php';
require_once __DIR__ . '/../model/Reporter.php';

class userController
{
    private $cm;

    public function __construct($connector = NULL)
    {
        if (empty($connector)) {
            $this->cm = new connector();
        } else $this->cm = $connector;
    }

    public function getMantisReporters($projectId)
    {
        $arrayReporters = array();
        $arrayIssues = $this->cm->getIssuesByProjectId($projectId);
        foreach ($arrayIssues as $issue) {
            $reporter = new Reporter();
            $reporter->setName($issue['reporter']['name']);
            $arrayReporters[] = $reporter;
        }
        $arrayReporters = array_unique($arrayReporters);

        return $arrayReporters;
    }

    public function getZendeskReporters()
    {
        $arrayResult = array();

        $userObjects = $this->cm->getZendeskReporters();

        foreach ($userObjects->users as $user) {
            if (!empty($user->email)) {
                $arrayResult[] = $user;
            }
        }

        return $arrayResult;
    }

    public function getThisZendeskReporter($userZendeskId)
    {
        $user = $this->cm->getThisZendeskReporter($userZendeskId);
        return $user->user;
    }

}
