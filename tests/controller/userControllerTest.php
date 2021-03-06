<?php
require_once __DIR__ . '/../../src/controller/userController.php';
require_once __DIR__ . '/FakeConector.php';

class FakeReporter
{
    public $id;
    public $name;
    public $email;


    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}


class FakeResult
{
    public $user;
    public $users;


    function __construct()
    {
        $this->user = $this->createReporter(1, "Cristiano Ronaldo", "tristiano@portugal.pt");
        $this->users = array(
            $this->createReporter(1, "Caio", "caio@company.org"),
            $this->createReporter(2, "Musta", NULL),
            $this->createReporter(3, "Brahim", "brahim@company.org"),
            $this->createReporter(4, "Extintor", "apagamifuego@company.org"),
            $this->createReporter(5, "Telefono", "llamame@company.org")
        );
    }

    private function createReporter($id, $name, $email)
    {
        $repo = new FakeReporter();
        $repo->setName($name);
        $repo->setId($id);
        $repo->setEmail($email);

        return $repo;
    }
}


class userControllerTest extends PHPUnit_Framework_TestCase
{


    /*protected function setUp()
    {
        $this->mockConnector = $this->getMock('connector', //nombre de la clase
            array('getIssuesByProjectId', 'getZendeskReporters'), //nombre de las funciones
            array('1') //parametros para las funciones
        );
    }*/

    /**
     * method: getMantisReporters
     * when: EmptyProjectId
     * with:
     * should: returnEmptyArray
     */
    public function test_getMantisReporters_withEmptyProjectId_returnEmptyArray()
    {
        $reporter1 = new Reporter();
        $reporter1->setName('Pepito');

        $reporter2 = new Reporter();
        $reporter2->setName('Caio');

        $expected = array($reporter1, $reporter2);

        // Create a stub for the SomeClass class
        $stub = $this->getMock('connector', //Class name
            array('getIssuesByProjectId'), //method name
            array('1') //parametros para las funciones
        );
        // Configure the stub
        $stub->expects($this->once())
            ->method('getIssuesByProjectId')
            ->with($this->equalTo('1'))
            ->will($this->returnValue(array(
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
        )));

        $usercontroller = new userController($stub);
        $this->assertEquals($usercontroller->getMantisReporters(1), $expected);
    }

    /**
     * method: getZendeskReporters
     * when: xx
     * with:
     * should: returnArrayUsersWithEmail
     */
    public function test_getZendeskReporters_xx__returnArrayUsersWithEmail()
    {
        $stub = $this->getMock('connector', //Class name
            array('getZendeskReporters') //Method
        );

        $userObjects = new FakeResult();

        $stub->expects($this->once())
            ->method('getZendeskReporters')
            ->will($this->returnValue($userObjects));

        $this->assertEquals(is_array($userObjects->users), true);
        $this->assertCount(5, $userObjects->users);

        $reporter1 = $this->createReporter(1, "Caio", "caio@company.org");
        $reporter2 = $this->createReporter(3, "Brahim", "brahim@company.org");
        $reporter3 = $this->createReporter(4, "Extintor", "apagamifuego@company.org");
        $reporter4 = $this->createReporter(5, "Telefono", "llamame@company.org");

        $expected = array($reporter1, $reporter2, $reporter3, $reporter4);

        $userController = new userController($stub);
        $this->assertEquals($expected, $userController->getZendeskReporters());
    }

    private function createReporter($id, $name, $email)
    {
        $reporter = new Reporter();
        $reporter->setName($name);
        if(!empty($id)) $reporter->setId($id);
        $reporter->setEmail($email);
        return $reporter;
    }

    /**
     * method: getThisZendeskReporter
     * when: userZendeskIdIsNULL
     * with:
     * should:
     */
    public function test_getThisZendeskReporter___()
    {
        $stub = $this->getMock('connector', //Class name
            array('getThisZendeskReporter') //Method
        );

        $stdObject = new stdClass();
        $stdObject->user = new stdClass();
        $stdObject->user->name = "Cristiano Ronaldo";
        $stdObject->user->email = "tristiano@portugal.pt";

        $stub->expects($this->once())
            ->method('getThisZendeskReporter')
            ->will($this->returnValue($stdObject));

        $expected = $this->createReporter(null, "Cristiano Ronaldo", "tristiano@portugal.pt");
        $userController = new userController($stub);

//        $this->assertTrue($this->reportersIguales($expected, $userController->getThisZendeskReporter(1)));

        $this->assertEquals($expected, $userController->getThisZendeskReporter(1));

    }

    protected function reportersIguales($r1, $r2) {
        if($r1->getName() != $r2->getName()) return 1;
        if($r1->getEmail() != $r2->getEmail()) return 2;

        return true;
    }
}