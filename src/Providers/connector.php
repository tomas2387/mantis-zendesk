<?php
require_once __DIR__ . '/Mantis/MantisProvider.php';
require_once __DIR__ . '/Zendesk/ZendeskProvider.php';

class connector
{
    private $mw;
    private $zw;

    public function __construct()
    {
        $this->mw = new MantisProvider();
        $this->zw = new ZendeskProvider();
    }

    public function getIssues($projectName)
    {
        $projectID = $this->mw->getProjectIdFromName($projectName);
        if (!isset($projectID) || empty($projectID)) return array('error' => "That project doesn't exists!");

        return $this->mw->getProjectIssues($projectID);
    }

    public function getIssuesByProjectId($projectId)
    {
        return $this->mw->getProjectIssues($projectId);
    }

    public function getProjects()
    {
        return $this->mw->getProjects();
    }

    public function getVersion()
    {
        return $this->mw->getVersion();
    }

    public function getZendeskReporters()
    {
        return $this->zw->getUsers();
    }

    public function getThisZendeskReporter($userZendeskId)
    {
        return $this->zw->getUser($userZendeskId);
    }

    public function sendTicketsToZendesk($ZendeskTicketsObjects)
    {
        return $this->zw->createTickets($ZendeskTicketsObjects);
    }
}