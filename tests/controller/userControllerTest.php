<?php
require_once __DIR__ . '/../../mantis/controller/userController.php';
require_once __DIR__ . '/FakeConector.php';

class FakeReporter {
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


    public $users;

    private function createReporter($id, $name, $email)
    {
        $repo = new FakeReporter();
        $repo->setName($name);
        $repo->setId($id);
        $repo->setEmail($email);

        return $repo;
    }

    function __construct()
    {
        $this->users = array(
            $this->createReporter(1, "Caio", "caio.araujo@eyeos.org"),
            $this->createReporter(2, "Musta", NULL),
            $this->createReporter(3, "Brahim", "brahim@eyeos.org"),
            $this->createReporter(4, "Extintor", "apagamifuego@eyeos.org"),
            $this->createReporter(5, "Telefono", "llamame@eyeos.org")
        );
    }
}


class userControllerTest extends PHPUnit_Framework_TestCase
{

    private $mockConnector;

    protected function setUp()
    {
        $this->mockConnector = $this->getMock('connector', //nombre de la clase
            array('getIssuesByProjectId', 'getZendeskReporters'), //nombre de las funciones
            array('1') //parametros para las funciones
        );
    }

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
        $stub = $this->getMock('connector', //nombre de la clase
            array('getIssuesByProjectId'), //nombre de las funciones
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
        $stub = $this->getMock('connector', //nombre de la clase
            array('getZendeskReporters') //nombre de las funciones
        );

        $userObjects = new FakeResult();

        $stub->expects($this->once())
            ->method('getZendeskReporters')
            ->will($this->returnValue( $userObjects ));

        $this->assertEquals( is_array($userObjects->users), true );
        $this->assertCount( 5, $userObjects->users  );

        $reporter1 = $this->createReporter(1, "Caio", "caio.araujo@eyeos.org");
        $reporter2 = $this->createReporter(3, "Brahim", "brahim@eyeos.org");
        $reporter3 = $this->createReporter(4, "Extintor", "apagamifuego@eyeos.org");
        $reporter4 = $this->createReporter(5, "Telefono", "llamame@eyeos.org");

        $expected = array($reporter1, $reporter2, $reporter3, $reporter4);

        $userController = new userController($stub);
        $this->assertEquals($expected, $userController->getZendeskReporters() );
    }

    private function createReporter($id, $name, $email)
    {
        $reporter = new FakeReporter();
        $reporter->setName($name);
        $reporter->setId($id);
        $reporter->setEmail($email);
        return $reporter;
    }

    /**
     * method: getThisZendeskReporter
     * when: userZendeskIdIsNULL
     * with:
     * should:
     */
    /*public function test_getThisZendeskReporter___(){
        $fc = new FakeConector();
        $expected = $fc->getThisZendeskReporter();
        $userController = new userController($fc);
        $this->assertEquals($userController->getThisZendeskReporter(NULL), $expected);
    }*/
}