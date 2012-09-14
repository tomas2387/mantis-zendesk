<?php
require_once __DIR__ . '/../../mantis/controller/userController.php';
require_once __DIR__ . '/FakeConector.php';


class userControllerTest extends PHPUnit_Framework_TestCase
{
    /**
     * method: test_getMantisReporters_withEmptyProjectId
     * when:
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

        $fc = new FakeConector();
        $usercontroller = new userController($fc);
        $this->assertEquals($usercontroller->getMantisReporters(NULL), $expected);
    }
}