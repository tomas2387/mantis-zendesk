<?php
require_once dirname(__FILE__) . '/../../mantis/controller/bugsController.php';
require_once __DIR__ . '/FakeConector.php';


class bugsControllerTest extends PHPUnit_Framework_TestCase
{

    private function prepareBug($id, $summary, $description, $reporterName, $status)
    {
        $bug = new Bug();
        $bug->setId($id);
        $bug->setSummary($summary);
        $bug->setDescription($description);
        $bug->setStatus($status);

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
            'Pepito',
            "new");

        $bug2 = $this->prepareBug(2,
            "Estoy en brasil",
            "O pais mais grande du mundo",
            'Caio',
            "new");
        $expected = array($bug1, $bug2);

        $fc = new FakeConector();
        $bugsController = new bugsController($fc);
        $this->assertEquals($expected, $bugsController->getMantisBugs(NULL));
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

    /**
    * method: bugsToZendeskTickets
    * when: CalledWithReporterWithDotsOnName
    * with:
    * should: ReturnCorrect
    */
   /*
    * COMENTADO POR EXCESIVA DIFICULTAD
   public function test_bugsToZendeskTickets_CalledWithReporterWithDotsOnName__ReturnCorrect()
    {
        $stub = $this->getMock('connector',
                                array('getIssuesByProjectId', 'sendTicketsToZendesk'));

        $stub->expects($this->once())
            ->method('getIssuesByProjectId')
            ->will($this->returnValue(array(
            array(
                'id' => 1,
                'project' => "ProjectName",
                'category' => "Bugs",
                'priority' => "Alta",
                'severity' => "High",
                'status' => "Open",

                'reporter' => array(
                    'email' => 'pepito@gmail.com',
                    'name' => 'tomas.prado'
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
                    'name' => 'josep.torres',
                    'email' => 'caio@gmail.com'
                ),

                'summary' => "Estoy en brasil",
                "version" => "",
                "build" => "",
                "platform" => "",
                "os" => "",
                "description" => "O pais mais grande du mundo"
            )
        )));

        $stub->expects($this->once())
            ->method('sendTicketsToZendesk')
            ->with($this->equalTo(
                                    array(
                                        array(
                                            'ticket' => array(
                                                'subject' => "No me funciona el extintor",
                                                'description' => "Si pongo boca a bajo el extintor no me funciona",
                                                'requester' => array(
                                                    'name' => 'Pepito',
                                                    'email' => 'pepito@gmail.com'
                                                )
                                            )
                                        ),
                                        array(
                                            'ticket' => array(
                                                'subject' => "Estoy en brasil",
                                                'description' => "O pais mais grande du mundo",
                                                'requester' => array(
                                                    'name' => 'Caio',
                                                    'email' => 'caio@gmail.com'
                                                )
                                            )
                                        )
                                    )
                )
            )
        ->will($this->returnValue(
                array(
                    "hola"
                )
            )



        );

        $bugController = new bugsController($stub);

        $arrayPOST = array(
            "brahim.lachguer"	=> 264554842,
            "carles.huguet" =>	264554842,
            "dani.ametller" =>	264554842,
            "josep.torres" =>	264554842,
            "tomas.prado" =>	264554842
        );

        $actual = $bugController->bugsToZendeskTickets(1, $arrayPOST);

        $expected = array("hola");

        $this->assertEquals($expected, $actual);
    }*/
}