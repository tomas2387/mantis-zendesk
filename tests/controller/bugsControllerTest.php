<?php
require_once dirname(__FILE__) . '/../../mantis/controller/bugsController.php';
require_once __DIR__ . '/FakeConector.php';


class bugsControllerTest extends PHPUnit_Framework_TestCase
{

    protected function setUp()
    {

    }

    private function prepareBug($id, $summary, $description, $reporterName)
    {
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

        $fc = new FakeConector();
        $bugsController = new bugsController($fc);
        $this->assertEquals($bugsController->getMantisBugs(NULL), $expected);
    }

    /**
     * method: getMantisBugs
     * when: CalledWithNullParameters
     * with:
     * should: ReturnEmptyArray
     */
    public function test_getMantisBugs_CalledWithNullParameters__ReturnEmptyArray()
    {
        $fc = new FakeConector(array());
        $bugsController = new bugsController($fc);
        $this->assertEquals($bugsController->getMantisBugs(NULL), array());
    }
}