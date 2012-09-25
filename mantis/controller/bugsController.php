<?php
require_once __DIR__ . '/../data/connector.php';

require_once __DIR__ . '/userController.php';

require_once __DIR__ . '/../model/Bug.php';
require_once __DIR__ . '/../model/Reporter.php';
require_once __DIR__ . '/../model/Result.php';


class bugsController
{
    const NEW_BUG_MANTIS_CODE = "10";
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
            if( ($selectOnlyOpenIssues && $entryBug['status']['id'] == bugsController::NEW_BUG_MANTIS_CODE) ||
                ( ! $selectOnlyOpenIssues) )
            {
                $bug = new Bug();
                $bug->setId($entryBug['id']);
                $bug->setSummary(utf8_encode($entryBug['summary']));
                $bug->setDescription(utf8_encode($entryBug['description']));
                $bug->setStatus($entryBug['status']['name']);
                if(isset($entryBug['additional_information']))
                    $bug->setAdditionalInformation(utf8_encode($entryBug['additional_information']));

                if(isset($entryBug['steps_to_reproduce']))
                    $bug->setStepsToReproduce(utf8_encode($entryBug['steps_to_reproduce']));

                $reporter = new Reporter();
                $reporter->setName(utf8_encode($entryBug['reporter']['name']));
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
            $reporter = $bug->getReporter()->getName();
            $reporter = str_replace('.', '_', $reporter);
            $zendeskUserReporterId = $userMap[$reporter];
            $zendeskUser = $uc->getThisZendeskReporter($zendeskUserReporterId);
            $ZendeskTicketsObjects[] = $this->parseOneBug($bug, $zendeskUser);
        }

        $responseMigration = $this->cm->sendTicketsToZendesk($ZendeskTicketsObjects);

        return $responseMigration;
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


        $summary = $mantisBug->getSummary();
        if( ! isset($summary) || empty($summary))   {
            $summary = "null";
        }

        if( ! isset($finalDescription) || empty($finalDescription))   {
            $finalDescription = "null";
        }

        return array(
            'ticket' => array(
                'subject' => $summary,
                'description' => $finalDescription,
                'requester' => array(
                    'name' => $zendeskUser->getName(),
                    'email' => $zendeskUser->getEmail()
                )
            )
        );
    }


}
