<?php
require_once dirname( __FILE__ ) . '/../data/connector.php';

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
            $arrayReporters[] = $issue['reporter']['name'];
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
