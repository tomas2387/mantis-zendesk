<?php
require_once __DIR__ . '/../data/connector.php';

require_once __DIR__ . '/userController.php';

require_once __DIR__ . '/../model/Bug.php';
require_once __DIR__ . '/../model/Reporter.php';
require_once __DIR__ . '/../model/Result.php';


class bugsController
{
    private $cm;

    public function __construct($cm = null)
    {
        if (isset($cm)) {
            $this->cm = $cm;
        } else {
            $this->cm = new connector();
        }
    }

    public function getMantisBugs($projectId, $selectOnlyOpenIssues=true)
    {
        $result = array();

        $ArrayMantisBugs = $this->cm->getIssuesByProjectId($projectId);
        foreach ($ArrayMantisBugs as $entryBug) {
            if( ($selectOnlyOpenIssues && $entryBug['status']['name'] == "new") ||
                ( ! $selectOnlyOpenIssues) )
            {
                $bug = new Bug();
                $bug->setId($entryBug['id']);
                $bug->setSummary($entryBug['summary']);
                $bug->setDescription($entryBug['description']);
                $bug->setStatus($entryBug['status']['name']);
                if(isset($entryBug['additional_information']))
                    $bug->setAdditionalInformation($entryBug['additional_information']);

                if(isset($entryBug['steps_to_reproduce']))
                    $bug->setStepsToReproduce($entryBug['steps_to_reproduce']);

                $reporter = new Reporter();
                $reporter->setName($entryBug['reporter']['name']);
                $bug->setReporter($reporter);

                $result[] = $bug;
            }
        }

        return $result;
    }

    public function bugsToZendeskTickets($projectId, $userMap, $selectOnlyOpenIssues=true)
    {
        $mantisBugs = $this->getMantisBugs($projectId, $selectOnlyOpenIssues);

        $ZendeskTicketsObjects = array();

        $uc = new userController($this->cm);
        foreach ($mantisBugs as $bug) {
            $zendeskUserReporterId = $userMap[$bug->getReporter()->getName()];

            $zendeskUser = $uc->getThisZendeskReporter($zendeskUserReporterId);
            $ZendeskTicketsObjects[] = $this->parseOneBug($bug, $zendeskUser);
        }

        $responseMigration = $this->cm->sendTicketsToZendesk($ZendeskTicketsObjects);

        $result = new Result();
        if(is_null($responseMigration)) {
            $result->id = 0;
            $result->text = "No tickets to create on Zendesk. You must be sure you selected the right project";
        }
        else if(is_array($responseMigration)) {
            $result->id = 1;
            foreach($responseMigration as $oneResponse) {
                $result->text = "";
                if($oneResponse !== true) {
                    $result->id = 0;
                    $result->text .= $oneResponse . '<br>';
                }
            }
        }

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
        $finalDescription = $mantisBug->getDescription();

        $steps = $mantisBug->getStepsToReproduce();
        if( isset($steps) && !empty($steps))
        {
            $finalDescription .= "\n Steps to reproduce--> \n" . $steps;
        }

        $aditional = $mantisBug->getAdditionalInformation();
        if (isset($aditional) && !empty($aditional)) {
            $finalDescription .= "\n Additional Information--> \n" . $aditional;
        }

        return array(
            'ticket' => array(
                'subject' => $mantisBug->getSummary(),
                'description' => $finalDescription,
                'requester' => array(
                    'name' => $zendeskUser->name,
                    'email' => $zendeskUser->email
                )
            )
        );
    }


}
