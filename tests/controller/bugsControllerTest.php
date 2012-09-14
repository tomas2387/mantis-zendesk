<?php
require_once dirname(__FILE__) . '/../../mantis/controller/bugsController.php';

class FakeConnector
{
    private $arrayReturn;

    function __construct($array = NULL) {
        if( ! is_null($array) ) {
            $this->arrayReturn = $array;
        }
        else {
            $this->arrayReturn = array(
                array(
                    'id' => 1,
                    'project' => "ProjectName",
                    'category' => "Bugs",
                    'priority' => "Alta",
                    'severity' => "High",
                    'status' => "Open",

                    'reporter' => array(
                        'name' => 'Pepito'
                    ),

                    'summary' => "No me funciona el extintor",
                    "version" => "",
                    "build" => "",
                    "platform" => "",
                    "os" => "",
                    "description" => "Si pongo boca a bajo el extintor no me funciona"

                ),
                array(
                    'id' => 2,
                    'view_state' => "state",
                    'last_updated' => "321312",
                    'project' => "ProjectName",
                    'category' => "Bugs",
                    'priority' => "Alta",
                    'severity' => "High",
                    'status' => "Open",

                    'reporter' => array(
                        'name' => 'Caio'
                    ),

                    'summary' => "Estoy en brasil",
                    "version" => "",
                    "build" => "",
                    "platform" => "",
                    "os" => "",
                    "description" => "O pais mais grande du mundo"
                )
            );
        }
    }

    function getIssuesByProjectId($projectId)
    {
        return $this->arrayReturn;
    }
}

class bugsControllerTest extends PHPUnit_Framework_TestCase
{

    protected function setUp()
    {

    }

    private function prepareBug($id, $summary, $description, $reporterName) {
        $bug = new Bug();
        $bug->setId($id);
        $bug->setSummary($summary);
        $bug->setDescription($description);

        $reporter = new Reporter();
        $reporter->setName($reporterName);

        $bug->setReporter($reporter);

        return $bug;
    }

    /**
     * method: getMantisBugs
     * when:  CalledWithCorrectParameters
     * with:
     * should: returnCorrectAnswer
     */
    public function test_getMantisBugs_CalledWithCorrectParameters_returnCorrectAnswer()
    {
        $bug1 = $this->prepareBug(1,
            "No me funciona el extintor",
            "Si pongo boca a bajo el extintor no me funciona",
            'Pepito');

        $bug2 = $this->prepareBug(2,
            "Estoy en brasil",
            "O pais mais grande du mundo",
            'Caio');
        $expected = array($bug1, $bug2);

        $fc = new FakeConnector();
        $bugsController = new bugsController($fc);
        $this->assertEquals($bugsController->getMantisBugs(NULL), $expected);
    }

    /**
    * method: getMantisBugs
    * when: CalledWithNullParameters
    * with:
    * should: ReturnEmptyArray
    */
    public function test_getMantisBugs_CalledWithNullParameters__ReturnEmptyArray() {
        $fc = new FakeConnector(array());
        $bugsController = new bugsController($fc);
        $this->assertEquals($bugsController->getMantisBugs(NULL), array());
    }
}