<?php
include (MANTIS2ZENDESK_ROOT . '/mantis/data/connector.php');
include (MANTIS2ZENDESK_ROOT . '/mantis/controller/userController.php');

class bugsController
{
    private $cm;
    public function __construct() {
        $this->cm = new connector();
    }

    public function getMantisBugs($projectId)
    {
        return $this->cm->getIssuesByProjectId($projectId);
    }

    public function bugsToZendeskTickets($projectId, $userMap) {
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
    private function parseOneBug($mantisBug, $zendeskUser) {
            $arrZD = array(
                "z_subject" => $mantisBug["summary"],
                "z_description" => $mantisBug["description"],
                "z_recipient" => "support@zendesk.com",
                "z_name" => $zendeskUser->name,
                "z_requester" => $zendeskUser->email
            );

            if (isset($mantisBug["steps_to_reproduce"]))
            {
                $arrZD["z_description"] = $arrZD["z_description"] ."\n steps to reproduce--> \n". $mantisBug["steps_to_reproduce"];
            }

            if (isset($mantisArr["additional_information"]))
            {
                $arrZD["z_description"] = $arrZD["z_description"] ."\n additional information--> \n". $mantisBug["additional_information"];
            }

            return array(
                        'ticket' => array(
                            'subject' => $arrZD['z_subject'],
                            'description' => $arrZD['z_description'],
                            'requester' => array(
                                'name' => $arrZD['z_name'],
                                'email' => $arrZD['z_requester']
                            )
                        )
                    );
    }


}
