<?php
define('MANTIS2ZENDESK_ROOT', '../..');

include ('../../mantis/controller/bugsController.php');

class FakeConnector
{
    function getIssuesByProjectId($projectId)
    {
        return array(
            array(
                'reporter' => array(
                    'name' => 'Pepito'
                )
            ),
            array(
                'reporter' => array(
                    'name' => 'Caio'
                )
            )

        );
    }
}

class bugsControllerTest extends PHPUnit_Framework_TestCase
{

    protected function setUp()
    {

    }

    /**
     * method: test_getMantisReporters_withEmptyProjectId
     * when:
     * with:
     * should: return NULL
     */
    public function test_getMantisReporters_withEmptyProjectId()
    {
        $fc = new FakeConnector();
        $usercontroller = new userController($fc);
        $this->assertEquals($usercontroller->getMantisReporters(NULL), NULL);
    }
}