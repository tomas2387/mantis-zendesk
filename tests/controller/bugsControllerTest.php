<?php
require_once dirname(__FILE__) . '/mantis/controller/bugsController.php';

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
        $bugsController = new bugsController($fc);
        $this->assertEquals($usercontroller->getMantisReporters(NULL), NULL);
    }
}