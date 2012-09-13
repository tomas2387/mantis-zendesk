<?php
require_once('mantisWrapper.php');
require_once('zendeskWrapper.php');

class connector
{
    private $mw;
    private $zw;

    public function __construct()
    {
        $this->mw = new mantisWrapper();
        $this->zw = new zendeskWrapper();
    }

    public function getIssues($projectName)
    {
        $projectID = $this->mw->getProjectIdFromName($_GET['projectName']);
        if (!isset($projectID) || empty($projectID)) return json_encode(array('error' => "That project doesn't exists!"));

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