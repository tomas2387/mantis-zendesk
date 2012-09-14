<?php
require_once __DIR__ . '/../data/connector.php';

require_once __DIR__ . '/userController.php';

require_once __DIR__ . '/../model/Bug.php';
require_once __DIR__ . '/../model/Reporter.php';

class bugsController
{
    private $cm;

    public function __construct($cm = null)
    {
        if( isset($cm)) {
            $this->cm = $cm;
        }
        else {
            $this->cm = new connector();
        }
    }

    public function getMantisBugs($projectId)
    {
        $result = array();

        $ArrayMantisBugs = $this->cm->getIssuesByProjectId($projectId);
        foreach($ArrayMantisBugs as $entryBug) {
            $bug = new Bug();
            $bug->setId($entryBug['id']);
            $bug->setSummary($entryBug['summary']);
            $bug->setDescription($entryBug['description']);

            $reporter = new Reporter();
            $reporter->setName($entryBug['reporter']['name']);
            $bug->setReporter($reporter);

            $result[] = $bug;
        }

        return $result;
    }

    public function bugsToZendeskTickets($projectId, $userMap)
    {
        $mantisBugs = $this->getMantisBugs($projectId);

        $ZendeskTicketsObjects = array();

        $uc = new userController($this->cm);
        foreach ($mantisBugs as $bug) {
            $zendeskUserReporterId = $userMap[$bug['reporter']['name']];

            $zendeskUser = $uc->getThisZendeskReporter($zendeskUserReporterId);
            $ZendeskTicketsObjects[] = $this->parseOneBug($bug, $zendeskUser);
        }

        $result = $this->cm->sendTicketsToZendesk($ZendeskTicketsObjects);
        return $result;
    }

    /*
     * method parseOneBug
     * @params
     *  $mantisBug type of array:
     *                  summary => title of the bug
     *                  description => the description
     *                  reporter => the array with the reporter data
     *                          name => the name of the reporter
     *                          email => the email of the reporter
     *                  steps_to_reproduce => more description
     *                  additional_information => and much more description
     *  $zendeskUser type of php object:
     *                  "user": {
     *                       "id":   35436,
     *                       "name": "Johnny Agent",
     *                       "email": "johnny@example.com",
     *                          ...
     *                     }
     */
    private function parseOneBug($mantisBug, $zendeskUser)
    {
        if (isset($mantisBug["steps_to_reproduce"])) {
            $mantisBug["description"] += "\n steps to reproduce--> \n" . $mantisBug["steps_to_reproduce"];
        }

        if (isset($mantisArr["additional_information"])) {
            $mantisBug["description"] += "\n additional information--> \n" . $mantisBug["additional_information"];
        }

        return array(
            'ticket' => array(
                'subject' => $mantisBug["summary"],
                'description' => $mantisBug["description"],
                'requester' => array(
                    'name' => $zendeskUser->name,
                    'email' => $zendeskUser->email
                )
            )
        );
    }


}
