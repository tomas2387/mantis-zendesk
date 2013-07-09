<?php
require_once __DIR__ . '/../Providers/connector.php';
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
                $reporter = new Reporter();
                $reporter->setId($user->id);
                $reporter->setName($user->name);
                $reporter->setEmail($user->email);
                $arrayResult[] = $reporter;
            }
        }

        return $arrayResult;
    }

    public function getThisZendeskReporter($userZendeskId)
    {
        $object = $this->cm->getThisZendeskReporter($userZendeskId);
        $user = $object->user;

        $reporter = new Reporter();
        $reporter->setName($user->name);
        $reporter->setEmail($user->email);

        return $reporter;
    }

}
